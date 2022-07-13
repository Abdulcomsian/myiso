<?php

namespace App\Http\Controllers;

use App\AddUsers;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserInfoController extends Controller
{

    public function user(Request $request)
    {

        $id = $request->id;
        $user = AddUsers::find($id);
        if ($request->input('password') != '' || !empty($request->input('password'))) {
            $pass = $request->input('password');
            $user->password = Hash::make($pass);
        }
        if ($request->file('user_image')) {
            $imagePath = $request->file('user_image');
            $imageName = uniqid() . "." . $request->file('user_image')->extension();

            $path = $request->file('user_image')->storeAs('/uploads/user', $imageName, 'public');
            $request->file('user_image')->move(public_path('/uploads/user'), $imageName);
            $user->profile_image = $path;
        }
        $user->persone_iso = $request->input('person_iso');
        $user->contact_number_iso = $request->input('contact_iso');
        $user->emailaddress_iso = $request->input('email_iso');

        if ($request->file('iso9001_certificate')) {
            $file_path = $request->file('iso9001_certificate');
            $file_name = uniqid() . "." . $request->file('iso9001_certificate')->extension();

            $path = $request->file('iso9001_certificate')->storeAs('/uploads/user', $file_name, 'public');
            $request->file('iso9001_certificate')->move(public_path('/uploads/user'), $file_name);
            $user->iso9001_certificate = $path;
        }
        $user->iso9001_expirydate = $request->input('iso9001_expirydate');
        $user->iso9001_description = $request->input('iso9001_description');

        if ($request->file('iso14001_certificate')) {
            $iso14001_certificate_path = $request->file('iso14001_certificate');
            $iso14001_certificate_name = uniqid() . "." . $request->file('iso14001_certificate')->extension();

            $iso14001_certificate_path = $request->file('iso14001_certificate')->storeAs('/uploads/user', $iso14001_certificate_name, 'public');
            $request->file('iso14001_certificate')->move(public_path('/uploads/user'), $iso14001_certificate_name);
            $user->iso14001_certificate = $iso14001_certificate_path;

        }
        $user->iso14001_expirydate = $request->input('iso14001_expirydate');
        $user->iso14001_description = $request->input('iso14001_description');

        if ($request->file('iso45001_certificate')) {
            $iso45001_certificate_path = $request->file('iso45001_certificate');
            $iso45001_certificate_name = uniqid() . "." . $request->file('iso45001_certificate')->extension();

            $iso45001_certificate_path = $request->file('iso45001_certificate')->storeAs('/uploads/user', $iso45001_certificate_name, 'public');
            $request->file('iso45001_certificate')->move(public_path('/uploads/user'), $iso45001_certificate_name);
            $user->iso45001_certificate = $iso45001_certificate_path;

        }

        $user->iso45001_expirydate = $request->input('iso45001_expirydate');
        $user->iso45001_description = $request->input('iso45001_description');

        if ($request->file('audit_report')) {
            $audit_report_path = $request->file('audit_report');
            $audit_report_name = uniqid() . "." . $request->file('audit_report')->extension();

            $audit_report_path = $request->file('audit_report')->storeAs('/uploads/user/audit_report', $audit_report_name, 'public');
            $request->file('audit_report')->move(public_path('/uploads/user/audit_report'), $audit_report_name);
            $user->audit_report = $audit_report_path;

        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');

        if ($request->input('phoneflag') == "preferred") {
            $phoneflag = "us";
        } else {
            $phoneflag = $request->input('phoneflag');
        }

        $user->phoneflag = $phoneflag;
        $user->phonecode = $request->input('phonecode');
        $user->iso_phone_code = $request->input('isophonecode');
        if ($request->input('isophoneflag') == "preferred") {
            $isophoneflag = "us";
        } else {
            $isophoneflag = $request->input('isophoneflag');
        }
        $user->iso_phone_flag = $isophoneflag;

        $user->director = $request->input('director');
        $user->sales_process = $request->input('sales_process');

        if ($request->file('company_profile')) {
            $imagePath = $request->file('company_profile');
            $imageName = uniqid() . "." . $request->file('company_profile')->extension();

            $path = $request->file('company_profile')->storeAs('/uploads/user', $imageName, 'public');
            $request->file('company_profile')->move(public_path('/uploads/user'), $imageName);

            $user->company_profile = $path;
        }

        $user->expiry_date = $request->input('expiry_date');

        $user->company_name = $request->input('company_name');
        $user->company_address = $request->input('company_address');
        $user->purchasing_process = $request->input('purchasing_process');
        $user->servicing_process = $request->input('servicing_process');
        $user->competency_process = $request->input('competency_process');
        $user->scope = $request->input('scope');
        $user->order_number = $request->input('order_number');
        $user->Company_overview = $request->input('Company_overview');

        $user->save();

        return redirect()->back();
    }

    public function the_faqs()
    {
        $all_faqs = DB::table('faqs')->get();
        $all_cates = DB::table('faqs_categories')->get();
        return view('dashboard.faq', compact('all_faqs', 'all_cates'));
    }

    public function explainer_videos()
    {
        $videos = DB::table('videos')->get();
        return view('dashboard.explainer_videos', compact('videos'));
    }

    public function quick_links()
    {
        $links = DB::table('quick_links')->get();
        $all_cates = DB::table('quick_links_categories')->get();
        return view('dashboard.quick_links', compact('links', 'all_cates'));
    }

    public function remove_iso(Request $request)
    {
        $id = $request->user_id;
        $handle = $request->handle;
        $user = AddUsers::find($id);
        if ($handle == 'audit_report') {
            if (File::exists(public_path($user->audit_report))) {
                File::delete(public_path($user->audit_report));
            }
            $user->audit_report = null;
        } else {
            $cert = $handle . '_certificate';
            $exp = $handle . '_expirydate';
            $desc = $handle . '_description';

            $user->$cert = null;
            $user->$exp = null;
            $user->$desc = null;
        }

        $user->save();

    }

}