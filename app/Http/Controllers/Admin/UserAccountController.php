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
        $data = User::findOrFail(Auth::user()->id);
        return view('admin.user.profile', compact('data'));
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
                $message->from("dev.support@togoteams.com", "Bank of Baroda Ltd.");
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
            'image' => 'required|image|mimes:jpeg,jpg,png',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $profile = User::where('id', Auth::user()->id)->first();
        $profile->name = $request->name;
        $profile->email = strtolower($request->email);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('assets/profile', $filename);
            $profile->image = $filename;
        }
        $profile->save();
        $message = "Profile Updated";
        Session::put('success', $message);
        // return redirect()->route('admin.dashboard');
        return redirect()->route('admin.dashboard')->with('success', 'Profile has been Update successfully!');
    }

    public function imageUpdate(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [

            'image' => 'required|image|mimes:jpeg,jpg,png',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $profile = User::where('id', Auth::user()->id)->first();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('assets/profile', $filename);
            $profile->image = $filename;
        }
        $profile->save();
        $message = "Profile Updated";
        Session::put('success', $message);
        // return redirect()->route('admin.dashboard');
        return redirect()->route('admin.dashboard')->with('success', 'Profile has been Update successfully!');
    }

    public function viewPasswordReset()
    {
        return view('admin.user.password-reset');
    }

    public function passwordReset(Request $request)
    {
        $validator =  $request->validate(
            [
                'current_password' => 'required|string|min:8',
            ],
            [
                'password' => 'required|min:8|confirmed',
            ],
            [
                'password.confirmed' => 'Confirm Password And Password has to be same.',
            ]
        );
        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect']);
        }
        if (Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['password' => 'New password must differ from current.']);
        }
        $user->password = Hash::make($request->password);
        $user->password_is_changed = 1;

        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'Password has been changed successfully!');
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
