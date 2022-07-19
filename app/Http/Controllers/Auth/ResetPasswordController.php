<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Validator;

class ResetPasswordController extends Controller
{
    public function __construct()
    {
    }

    public function passwordResetEmail(Request $request){
        $validator = \Validator::make($request->all(), [
            'email'  => 'required|email|max:255|exists:users,email',
        ]);

        $success = true;

        if ($validator->fails())
        {
            $success = false;
        }

        if ($success){
            $from_email = $request->email;
            $to_email = env('TO_EMAIL');
            Mail::send([], [], function ($message) use ($from_email,$to_email) {
                $message->to($to_email,'Admin')
                    ->from($from_email,'Hafiz')
                    ->subject('Password Reset Notification')
                    ->setBody(
                        '<br>
                <h3>Hi, Admin!</h3>
                <br>
                <p>Please reset password for <b>'.$from_email.'</b> this email.</p>
                <br>
                <h4>Thank you!</h4>
                <h4><a href="https://www.myisoonline.com/">Myisoonline.com</a></h4>',
                        'text/html'); // for HTML rich messages
            });
        }

        return response()->json(array(
            'success' => $success,
        ));
    }
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

//    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
//    protected $redirectTo = RouteServiceProvider::HOME;
}
