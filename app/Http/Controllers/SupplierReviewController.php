<?php

namespace App\Http\Controllers;

use App\supplier_review;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $userid = Auth::user()->id;
        $search = trim($request->query('q', ''));
        $all_suppliers = Supplier::where('user_id', $userid)->get();
        $query = supplier_review::where('user_id', $userid)->orderBy('id', 'DESC');
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('product_activity_area', 'like', "%{$search}%")
                  ->orWhere('other_issues', 'like', "%{$search}%")
                  ->orWhere('sup_id', 'like', "%{$search}%");
            });
        }
        $reviews = $query->paginate(10)->withQueryString();
        if ($request->ajax()) {
            return view('dashboard.form_records.partials.supplier_review_table', compact('reviews', 'userid'));
        }
        return view('dashboard.form_records.supplier_review', compact('reviews', 'userid', 'all_suppliers', 'search'));
    }

    public function store(Request $request)
    {
        $the_id = $this->ownerId($request);

        $review = new supplier_review();
        $review->user_id = $the_id;
        $this->fill($review, $request, 'product_activity_area');
        $review->attach_evidence = $this->uploadEvidence($request);
        $review->save();

        return redirect()->back()->with('Success', 'Data Save Successfully');
    }

    public function update(Request $request)
    {
        $review = $this->findOwned($request->id);
        $review->user_id = $this->ownerId($request);
        $this->fill($review, $request, 'product_activity_area_edit');
        if ($request->hasFile('attach_evidence')) {
            $review->attach_evidence = $this->uploadEvidence($request);
        }
        $review->save();

        return redirect()->back()->with([
            'message' => 'Record  updated successfully.!',
            'alert-type' => 'success',
        ]);
    }

    public function destroy(Request $request)
    {
        $this->findOwned($request->id)->delete();
        session()->flash('msg', 'Record deleted successfully.');
        return redirect()->back();
    }

    // Admin works on behalf of the user in the form; a normal user only on their own records
    private function ownerId(Request $request)
    {
        if (Auth::user()->role_type == 'admin') {
            return intval($request->input('user_id'));
        }
        return Auth::user()->id;
    }

    private function findOwned($id)
    {
        $review = supplier_review::findOrFail($id);
        if (Auth::user()->role_type != 'admin' && $review->user_id != Auth::user()->id) {
            abort(403);
        }
        return $review;
    }

    private function fill(supplier_review $review, Request $request, $areaField)
    {
        $review->sup_id = $request->input('sup_id');
        $review->qualityScore = $request->input('qualityScore');
        $review->priceScore = $request->input('priceScore');
        $review->DScore = $request->input('DScore');
        $review->OveralScore = $request->input('OveralScore');
        $review->AssesmentDate = $request->input('AssesmentDate');
        $review->other_issues = $request->input('other_issue');
        $review->product_activity_area = $request->input($areaField);
    }

    private function uploadEvidence(Request $request)
    {
        if (!$request->hasFile('attach_evidence')) {
            return null;
        }
        $file = $request->file('attach_evidence');
        $filename = rand() . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('supplier_review_evidence/'), $filename);
        return $filename;
    }
}
