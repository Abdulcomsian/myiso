<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Mgtreview;
use App\MgtreviewAction;
use App\MgtreviewAnswer;
use App\MgtreviewFile;
use App\MgtReviewQuestions;
use App\Objective;
use App\requirement;
use App\Helpers\HelperFunctions;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class MgtreviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /** where an uploaded answer file or meeting file is kept */
    const UPLOAD_PATH = '/uploads/user/mgtreviews_files/';

    public function index(Request $request)
    {
        $userid = Auth::user()->id;
        $search = trim($request->query('q', ''));

        $data = $this->listFor($userid, $search);

        if ($request->ajax()) {
            return view('dashboard.form_records.partials.management_reviews_table', $data);
        }

        // "Edit" opens the same form the add button does, filled in. With twelve
        // questions, three objective boxes, the actions and the files, the form
        // is far too big to pour into a popup from JavaScript.
        $editing = null;
        if ($request->query('edit')) {
            $editing = Mgtreview::where('user_id', $userid)->find($request->query('edit'));
        }
        $data['editing'] = $editing;
        $data['answers'] = $editing ? $this->answersFor($editing) : [];
        $data['search']  = $search;
        // what Part 3 C offers in its two dropdowns
        $data['actionOptions'] = self::actionOptions($userid);

        return view('dashboard.form_records.managment_reviews', $data);
    }

    /**
     * The rows for one user, plus the line above the table: the most recent
     * review that still has actions nobody has ticked off.
     */
    private function listFor($userid, $search)
    {
        $query = Mgtreview::with(['actions', 'answers'])->where('user_id', $userid);
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('meetingatt', 'like', "%{$search}%")
                  ->orWhere('chairedby', 'like', "%{$search}%")
                  ->orWhere('newquality', 'like', "%{$search}%")
                  ->orWhere('reviewdate', 'like', "%{$search}%");
            });
        }
        $userData = $query->orderBy('id', 'DESC')->paginate(10)->withQueryString();

        return ['userData' => $userData, 'openBanner' => self::openBanner($userid)];
    }

    /**
     * The newest review that has open actions, with the numbers the banner
     * needs. Null when there is nothing to chase.
     */
    /**
     * What Part 3 C offers in its two dropdowns, for one client.
     *
     * Objective lists the client's Objectives Tracker, Who lists their
     * employees. Both are built here rather than in the two views that need
     * them - the form and the script that adds a row to it - so the list a row
     * is drawn with and the list a new row is drawn with cannot drift apart.
     *
     * The value is the text that gets saved, because that is what the column
     * has always held and what the details popup and the open-actions count
     * read back. An objective can run to a paragraph now, so the label is
     * shortened for the dropdown while the whole thing is still what is saved.
     *
     * Admin pages pass the client's id, never the admin's.
     */
    public static function actionOptions($userId)
    {
        $objectives = Objective::where('user_id', $userId)
            ->orderBy('id', 'DESC')->get()
            ->map(function ($o) {
                $text = trim((string) $o->objective);
                return ['value' => $text, 'label' => Str::limit($text, 80)];
            })
            ->filter(function ($o) { return $o['value'] !== ''; })
            ->values()->all();

        $employees = Employee::where('user_id', $userId)
            ->orderBy('first_name')->get()
            ->map(function ($e) {
                $name = trim($e->first_name . ' ' . $e->surname);
                return $name !== '' ? $name : (string) $e->empNumber;
            })
            ->filter(function ($n) { return $n !== ''; })
            ->unique()->values()->all();

        return ['objectives' => $objectives, 'employees' => $employees];
    }

    public static function openBanner($userid)
    {
        $latest = Mgtreview::with('actions')->where('user_id', $userid)
            ->orderBy('reviewdate', 'DESC')->orderBy('id', 'DESC')->get()
            ->first(function ($r) { return $r->openActions() > 0; });

        if (!$latest) {
            return null;
        }
        return [
            'open'    => $latest->openActions(),
            'date'    => $latest->reviewdate,
            'nextdue' => $latest->nextreviewdue,
            'id'      => $latest->id,
        ];
    }

    /** the answers of one review, keyed by question number, ready for the form */
    private function answersFor(Mgtreview $rev)
    {
        $out = [];
        foreach ($rev->answers as $a) {
            $out[$a->question_no] = ['answer' => $a->answer, 'file' => $a->evidence_file];
        }
        return $out;
    }

    public function store(Request $request)
    {
        $request->validate(['reviewdate' => 'required']);

        if (Auth::check() && Auth::user()->role_type == 'admin' && $request->input('is_admin') == 'admin') {
            $userId = intval($request->input('user_id'));
        } else {
            $userId = Auth::user()->id;
        }

        try {
            $rev = new Mgtreview();
            $this->saveReview($request, $rev, $userId);
            return back()->with('message', 'Data Save Successfully');
        } catch (Exception $exc) {
            return back()->with('message', $exc->getMessage());
        }
    }

    public function update(Request $request)
    {
        $rev = Mgtreview::find($request->input('id'));
        if (!$rev) {
            return back();
        }

        if (Auth::check() && Auth::user()->role_type == 'admin' && $request->input('is_admin') == 'admin') {
            $userId = intval($request->input('user_id')) ?: $rev->user_id;
        } else {
            $userId = Auth::user()->id;
            if ($rev->user_id != $userId) {
                return back();                       // not this user's review
            }
        }

        $this->saveReview($request, $rev, $userId);
        return redirect($request->input('back') ?: '/add_management_review')->with('message', 'Data Save Successfully');
    }

    /**
     * Writes the review and everything hanging off it.
     *
     * Only the boxes that were actually posted are written, so a review
     * recorded on the old sixteen-box form keeps every word of it when it is
     * edited on the new one.
     */
    private function saveReview(Request $request, Mgtreview $rev, $userId)
    {
        $rev->user_id = $userId;
        foreach (['mgtreviewId', 'reviewdate', 'chairedby', 'meetingatt', 'nextreviewdue',
                  'newquality', 'newenvironmental', 'newhealthsafety'] as $f) {
            if ($request->has($f) && Schema::hasColumn('tbl_mgtreviews', $f)) {
                $rev->$f = $request->input($f);
            }
        }
        foreach (array_keys(Mgtreview::legacyFields()) as $f) {
            if ($request->has($f)) {
                $rev->$f = $request->input($f);
            }
        }

        // the old form's single attachment, still accepted so nothing breaks
        if ($request->file('attach_file') && Schema::hasColumn('tbl_mgtreviews', 'attach_file')) {
            if ($rev->attach_file && File::exists(public_path($rev->attach_file))) {
                File::delete(public_path($rev->attach_file));
            }
            $rev->attach_file = HelperFunctions::saveFile(self::UPLOAD_PATH, $request->file('attach_file'));
        }

        $rev->save();

        $this->saveAnswers($request, $rev);
        $this->saveActions($request, $rev);
        $this->saveFiles($request, $rev);
        $this->syncRequirement($rev);
        $this->addObjectives($request, $rev);

        return $rev;
    }

    /** one row per answered question, plus 'A' for the decisions box */
    private function saveAnswers(Request $request, Mgtreview $rev)
    {
        $posted = $request->input('mrq');
        if (!is_array($posted)) {
            return;
        }
        $keys = array_map(function ($q) { return (string) $q['no']; }, MgtReviewQuestions::all());
        $keys[] = 'A';

        foreach ($keys as $key) {
            if (!array_key_exists($key, $posted)) {
                continue;
            }
            $row = MgtreviewAnswer::firstOrNew(['mgtreview_id' => $rev->id, 'question_no' => $key]);
            $row->answer = $posted[$key];

            $file = $request->file('mrfile.' . $key);
            if ($file && $this->allowed($file, MgtReviewQuestions::labels()['accept'])) {
                if ($row->evidence_file && File::exists(public_path($row->evidence_file))) {
                    File::delete(public_path($row->evidence_file));
                }
                $row->evidence_file = HelperFunctions::saveFile(self::UPLOAD_PATH, $file);
            }
            $row->save();
        }
    }

    /**
     * One Part 3 C field, whether it was chosen from the dropdown or typed.
     *
     * Objective and Who are dropdowns now - the client's Objectives Tracker
     * and their employees - with an "Other" that reveals a box underneath.
     * Picking Other posts the marker, and the box beside it holds the words,
     * so either way what is stored is the same plain text the column has
     * always held. Nothing downstream has to know a dropdown was involved.
     */
    const OTHER = '__other__';

    private function pickedOrTyped(array $row, $field)
    {
        $picked = trim((string) ($row[$field] ?? ''));
        if ($picked === self::OTHER) {
            return trim((string) ($row[$field . '_other'] ?? ''));
        }
        return $picked;
    }

    /** Part 3 C, rewritten from what the form posted */
    private function saveActions(Request $request, Mgtreview $rev)
    {
        $rows = $request->input('mract');
        if (!is_array($rows)) {
            return;
        }
        MgtreviewAction::where('mgtreview_id', $rev->id)->delete();
        foreach ($rows as $row) {
            $text = $this->pickedOrTyped($row, 'action');
            if ($text === '') {
                continue;                            // an empty line is not an action
            }
            MgtreviewAction::create([
                'mgtreview_id' => $rev->id,
                'action'       => $text,
                'who'          => $this->pickedOrTyped($row, 'who') ?: null,
                'by_when'      => !empty($row['when']) ? $row['when'] : null,
                'done'         => !empty($row['done']),
            ]);
        }
    }

    /** Part 3 D: the ones ticked for removal go, the new ones are added */
    private function saveFiles(Request $request, Mgtreview $rev)
    {
        foreach ((array) $request->input('mrfiledrop', []) as $id) {
            $f = MgtreviewFile::where('mgtreview_id', $rev->id)->find($id);
            if ($f) {
                if (File::exists(public_path($f->file))) {
                    File::delete(public_path($f->file));
                }
                $f->delete();
            }
        }

        $accept = MgtReviewQuestions::files()['accept'];
        foreach ((array) $request->file('mrfiles', []) as $file) {
            if (!$file || !$this->allowed($file, $accept)) {
                continue;
            }
            MgtreviewFile::create([
                'mgtreview_id'  => $rev->id,
                'file'          => HelperFunctions::saveFile(self::UPLOAD_PATH, $file),
                'original_name' => $file->getClientOriginalName(),
            ]);
        }
    }

    /** an upload is only kept when its extension is one the form asked for */
    private function allowed($file, $accept)
    {
        $ext = strtolower($file->getClientOriginalExtension());
        $ok  = array_map(function ($e) { return ltrim(trim($e), '.'); }, explode(',', $accept));
        return $ext !== '' && in_array($ext, $ok, true);
    }

    /**
     * "Next review due" puts a row in Requirements Due, so the reminder turns
     * up on the Dashboard the way the client's form says it does. One row per
     * review, found again by its title and the date of the meeting.
     */
    private function syncRequirement(Mgtreview $rev)
    {
        if (!$rev->nextreviewdue || !$rev->reviewdate) {
            return;
        }
        $from = strtotime($rev->reviewdate);
        $to   = strtotime($rev->nextreviewdue);
        if (!$from || !$to || $to <= $from) {
            return;
        }
        // Requirements Due works in whole months from the completion date
        $months = max(1, (int) round(($to - $from) / (30.4375 * 86400)));
        $title  = MgtReviewQuestions::labels()['requirement_title'];

        $row = requirement::where('user_id', $rev->user_id)
            ->where('requirment_title', $title)
            ->where('completion_date', $rev->reviewdate)
            ->first();
        if (!$row) {
            $row = new requirement();
            $row->user_id          = $rev->user_id;
            $row->requirment_title = $title;
            $row->completion_date  = $rev->reviewdate;
        }
        $row->periods  = $months;
        $row->due_date = date('d-m-Y', $to);
        $row->save();
    }

    /**
     * Part 3 B: each box the meeting ticked for the tracker becomes an
     * objective, linked back to this review. The target, the owner and the
     * deadline are filled in on the Objectives Tracker itself.
     */
    private function addObjectives(Request $request, Mgtreview $rev)
    {
        $marked = (array) $request->input('addtotracker', []);
        foreach (MgtReviewQuestions::objectives()['boxes'] as $box) {
            if (empty($marked[$box['field']])) {
                continue;
            }
            // the whole box, not the first 500 characters: tbl_objectives.objective
            // is TEXT now, and cutting it here is what was losing the end of a
            // long objective between the meeting and the tracker
            $text = trim((string) $rev->{$box['field']});
            if ($text === '') {
                continue;
            }
            // One objective per box, so the guard has to name the box. Without
            // it, a meeting that wrote the same words under Quality and under
            // Environment filed only the first: the second looked like a
            // duplicate of it and was dropped.
            //
            // A row with no category cannot collide here. The only way its
            // text could match this box is if it was copied from it, and
            // anything copied from a box was given its category by the
            // migration that added the column.
            //
            // Anything added before the column was widened was stored cut, so
            // that older form is checked too - otherwise re-saving a review
            // with a long objective would file a second copy of it.
            $already = Objective::where('user_id', $rev->user_id)
                ->where('agreed_at', $rev->id)
                ->where('category', $box['field'])
                ->whereIn('objective', array_unique([$text, mb_substr($text, 0, 500)]))
                ->exists();
            if ($already) {
                continue;
            }
            $o = new Objective();
            $o->user_id      = $rev->user_id;
            $o->objective    = $text;
            // which box it was written under, so the tracker can show the same
            // heading the meeting used
            $o->category     = $box['field'];
            $o->how_measured = '';
            $o->target       = '';
            $o->agreed_at    = $rev->id;
            $o->agreed_on    = $rev->reviewdate ?: null;
            $o->status       = 'not_started';
            $o->save();
        }
    }

    public function destroy(Request $req)
    {
        $rev = Mgtreview::find($req->input('id'));
        if ($rev) {
            $this->deleteChildren($rev);
            $rev->delete();
        }
        return redirect('/add_management_review')->with([
            'message'    => 'Record  Deleted successfully.!',
            'alert-type' => 'success',
        ]);
    }

    /** the answers, actions and files of a review go with it */
    public static function deleteChildren(Mgtreview $rev)
    {
        foreach ($rev->files as $f) {
            if (File::exists(public_path($f->file))) {
                File::delete(public_path($f->file));
            }
        }
        MgtreviewFile::where('mgtreview_id', $rev->id)->delete();
        MgtreviewAction::where('mgtreview_id', $rev->id)->delete();
        MgtreviewAnswer::where('mgtreview_id', $rev->id)->delete();
    }
}
