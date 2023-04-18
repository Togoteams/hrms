<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
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

    public function profileUpdate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
        ]);
        $profile = User::where('id', Auth::user()->id)->first();
        $profile->name = $request->name;
        $profile->email = strtolower($request->email);
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
        $profile->save();

        return redirect()->back()->with('success', 'Password has been Changeded successfully!');
    }

}
