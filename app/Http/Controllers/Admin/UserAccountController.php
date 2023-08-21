<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserAccountController extends Controller
{
    public function viewProfile()
    {
        return view('admin.user.profile');
    }

    public function viewForgotPasswordPage()
    {
        return view('auth.user-forgot-password');
    }
    public function viewPasswordChangedPage()
    {
        return view('auth.user-password-changed');
    }

    public function forgotPassword(Request $request)
    {
        // return $request;

        $user = User::where('email', $request->email)->first();
        if (!empty($user)) {
            $user->unique_key = $user->id . base64_encode((string)time());
            $password_reset_link = url("user-reset-password" . "/" . $user->unique_key);
            $user->unique_key_generated_at = now();
            $user->save();

            $data = array(
                'email' => strtolower($request->email),
                'user_name' => ucwords($user->name),
                'password_reset_link' => $password_reset_link,
            );
            // return $data;
            // return view('emails.forgot-password')->with('data', $data);
            Mail::send('emails.forgot-password', ['data' => $data], function ($message) use ($data) {
                $message->to($data['email']);
                $message->from("mailtest@togoteams.com", "Bank of Baroda Ltd.");
                $message->subject("Forgot Password?");
            });
            return view('auth.after-email-sent');
        } else {
            return back()->withErrors(['email' => 'Invalid Email']); // Redirect back to the page with an error message
        }
    }

    public function resetPassword($unique_key)
    {
        // return $unique_key;

        $user = User::where('unique_key', $unique_key)->first();

        if (empty($user)) {
            return "Invalid Link";
        } elseif (!empty($user)) {
            $generatedAt = Carbon::parse($user->unique_key_generated_at);
            $user->email_verified_at = now();
            $currentTime = Carbon::now();
            $diffInMinutes = $generatedAt->diffInMinutes($currentTime);

            $data = array(
                'id' => strtolower($user->uuid),
            );
            if ($diffInMinutes >= 15) {
                // The difference is greater than or equal to 15 minutes
                return "Link is expired";
            } else {
                // The difference is less than 15 minutes
                return view('auth.user-reset-password')->with('data', $data);
            }
        } else {
            return "Something Else";
        }
    }

    public function profileUpdate(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'file' => 'required|file|mimes:jpeg,jpg,png',

        ]);
        $profile = User::where('id', Auth::user()->id)->first();
        $profile->name = $request->name;
        $profile->email = strtolower($request->email);
        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time() .'.' . $extension;
            $file->move('asset/image',$filename);
            $profile->file = $filename;
        }
        $profile->save();
        $message = "Profile Updated";
        Session::put('success', $message);
        return redirect()->back();
    }

    public function viewPasswordReset()
    {
        return view('admin.user.password-reset');
    }

    public function passwordReset(Request $request)
    {
        $validator =  $request->validate(
            [
                'password' => 'required|min:8|confirmed',
            ],
            [
                'password.confirmed' => 'Confirm Password And Password has to be same.',
            ]
        );
        $profile = User::where('id', Auth::user()->id)->first();
        $profile->password = Hash::make($request->password);
        $profile->password_is_changed=1;

        $profile->save();

        return redirect()->back()->with('success', 'Password has been Changeded successfully!');
    }

    public function resetPasswordSave(Request $request)
    {
        // return $request->password    ;
        $validator =  $request->validate(
            [
                'id' => 'required',
            ],
            [
                'password' => 'required|min:8|confirmed',
            ],
            [
                'password.confirmed' => 'Confirm Password And Password has to be same.',
            ]
        );
        $user = User::where('uuid', $request->id)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('password.changed');
    }
}
