<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Mgtreview;
use App\Objective;
use App\ObjectiveUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ObjectiveController extends Controller
{
    /** admins act on behalf of a user; everyone else on their own records */
    private function ownerId(Request $request)
    {
        return (Auth::check() && Auth::user()->role_type == 'admin')
            ? intval($request->input('user_id'))
            : Auth::user()->id;
    }

    public function index(Request $request)
    {
        $data = $this->listFor(Auth::user()->id, $request);

        if ($request->ajax()) {
            return view('dashboard.form_records.partials.objectives_table', $data);
        }
        return view('dashboard.form_records.objectives_tracker', $data);
    }

    /** the same list, for the user an admin is looking after */
    public function adminIndex(Request $request, $userid)
    {
        $data = $this->listFor(intval($userid), $request);
        $data['ownerId'] = intval($userid);

        if ($request->ajax()) {
            return view('dashboard.form_records.partials.objectives_table', $data);
        }
        return view('admin.adminform_records.objectives_tracker', $data);
    }

    /**
     * The same listing the tracker shows, minus the objectives already
     * achieved - what the Dashboard card carries.
     *
     * Static because HomeController needs it for the first paint, the way
     * AddUsersController reaches for MgtreviewController::openBanner(). The
     * card and its pager both come through here, so they cannot drift.
     */
    public static function dashboardList($userId)
    {
        $objectives = Objective::where('user_id', $userId)
            ->where('status', '<>', 'achieved')
            ->orderBy('deadline')->orderByDesc('id')->paginate(10);

        // one query for the latest note of every objective on this page
        $latest = [];
        $ids = $objectives->pluck('id')->all();
        if ($ids) {
            foreach (ObjectiveUpdate::whereIn('objective_id', $ids)
                        ->orderBy('update_date')->orderBy('id')->get() as $u) {
                $latest[$u->objective_id] = $u;
            }
        }

        // no $counts: the card has no filter chips, so six COUNT(*) would be
        // six queries for nothing. The two dropdowns are here so that turning
        // Edit back on later needs no other change.
        $employees = Employee::where('user_id', $userId)->orderBy('first_name')->get();
        $reviews   = Mgtreview::where('user_id', $userId)->orderByDesc('reviewdate')->get();

        return compact('objectives', 'latest', 'employees', 'reviews');
    }

    /** where the Dashboard card's pager fetches from: the list and nothing else */
    public function dashboardIndex(Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/home');            // a bare fragment is not a page
        }
        return view('dashboard.form_records.partials.objectives_table', array_merge(
            self::dashboardList(Auth::user()->id),
            ['showFilters' => false, 'actions' => ['view', 'progress']]
        ));
    }

    /** everything a list page needs for one user: rows, filters and the dropdowns */
    private function listFor($userId, Request $request)
    {
        $search = trim((string) $request->input('q', ''));
        $status = (string) $request->input('status', '');

        $query = Objective::where('user_id', $userId);
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('objective', 'like', "%{$search}%")
                  ->orWhere('target', 'like', "%{$search}%")
                  ->orWhere('person_responsible', 'like', "%{$search}%");
            });
        }
        if ($status !== '' && array_key_exists($status, Objective::statuses())) {
            $query->where('status', $status);
        }

        // the deadline is what the user is working towards, so lead with it
        $objectives = $query->orderBy('deadline')->orderByDesc('id')->paginate(10)->withQueryString();

        // one query for the latest note of every objective on this page, rather
        // than one query per row
        $latest = [];
        $ids = $objectives->pluck('id')->all();
        if ($ids) {
            foreach (ObjectiveUpdate::whereIn('objective_id', $ids)
                        ->orderBy('update_date')->orderBy('id')->get() as $u) {
                $latest[$u->objective_id] = $u;      // later rows win, so this ends up the newest
            }
        }

        $counts = ['' => Objective::where('user_id', $userId)->count()];
        foreach (array_keys(Objective::statuses()) as $key) {
            $counts[$key] = Objective::where('user_id', $userId)->where('status', $key)->count();
        }

        $employees = Employee::where('user_id', $userId)->orderBy('first_name')->get();
        $reviews   = Mgtreview::where('user_id', $userId)->orderByDesc('reviewdate')->get();

        return compact('objectives', 'latest', 'counts', 'employees', 'reviews', 'search', 'status');
    }

    public function store(Request $request)
    {
        $request->validate([
            'objective'    => 'required|string|max:500',
            'how_measured' => 'required|string|max:500',
            'target'       => 'required|string|max:255',
            'deadline'     => 'required|date',
            'agreed_on'    => 'nullable|date|required_if:agreed_at,custom',
        ]);

        $objective = new Objective();
        $objective->user_id = $this->ownerId($request);
        $this->fill($objective, $request);
        $objective->save();

        return back()->with('Success', 'Data Save Successfully');
    }

    public function update(Request $request)
    {
        $objective = Objective::find($request->input('id'));
        if (!$objective) {
            return back()->with('Error', 'Objective not found');
        }
        $request->validate([
            'objective'    => 'required|string|max:500',
            'how_measured' => 'required|string|max:500',
            'target'       => 'required|string|max:255',
            'deadline'     => 'required|date',
            'agreed_on'    => 'nullable|date|required_if:agreed_at,custom',
        ]);

        $this->fill($objective, $request);
        $objective->save();

        return back()->with('Success', 'Data Save Successfully');
    }

    private function fill(Objective $objective, Request $request)
    {
        $objective->objective          = $request->input('objective');
        $objective->how_measured       = $request->input('how_measured');
        $objective->starting_point     = $request->input('starting_point');
        $objective->target             = $request->input('target');
        $objective->how_achieved       = $request->input('how_achieved');
        $objective->person_responsible = $request->input('person_responsible');
        $objective->deadline           = $request->input('deadline');

        // Where it was agreed. agreed_at still points at a Management Review;
        // agreed_on is the date, taken from that review or typed by hand when
        // the meeting was not one. Both are written on every branch, so
        // switching from a review to a date and back never leaves the old
        // value behind.
        $agreed = (string) $request->input('agreed_at', '');
        if ($agreed === 'custom') {
            $objective->agreed_at = null;
            $objective->agreed_on = $request->input('agreed_on') ?: null;
        } elseif ($agreed !== '') {
            // scoped to the owner, so nobody can point at somebody else's review
            $review = Mgtreview::where('user_id', $objective->user_id)->find((int) $agreed);
            $objective->agreed_at = $review ? $review->id : null;
            $objective->agreed_on = ($review && $review->reviewdate) ? $review->reviewdate : null;
        } else {
            $objective->agreed_at = null;
            $objective->agreed_on = null;
        }

        $status = $request->input('status');
        $objective->status = array_key_exists($status, Objective::statuses()) ? $status : 'not_started';
    }

    /**
     * A progress note is added to the history, never written over the last one -
     * that history is the evidence an auditor asks for. The objective's own
     * status follows the newest note.
     */
    public function storeProgress(Request $request)
    {
        $objective = Objective::find($request->input('objective_id'));
        if (!$objective) {
            return back()->with('Error', 'Objective not found');
        }
        $request->validate([
            'note'   => 'required|string',
            'status' => 'required|string',
        ]);

        $update = new ObjectiveUpdate();
        $update->objective_id = $objective->id;
        $update->user_id      = $objective->user_id;
        $update->note         = $request->input('note');
        $update->status       = array_key_exists($request->input('status'), Objective::statuses())
            ? $request->input('status') : $objective->status;
        $update->update_date  = $request->input('update_date') ?: date('Y-m-d');

        if ($request->file('evidence')) {
            $file = $request->file('evidence');
            $name = rand() . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('objective_evidence/'), $name);
            $update->evidence = $name;
        }
        $update->save();

        $objective->status = $update->status;
        $objective->save();

        return back()->with('Success', 'Data Save Successfully');
    }

    public function destroy(Request $request)
    {
        $objective = Objective::find($request->input('id'));
        if ($objective) {
            ObjectiveUpdate::where('objective_id', $objective->id)->delete();
            $objective->delete();
        }
        return back()->with('Success', 'Data Deleted Successfully');
    }
}
