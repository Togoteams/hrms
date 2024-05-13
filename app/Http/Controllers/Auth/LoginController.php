<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function authentication(Request $request)
    {
        if ($request->isMethod('post')) {

            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            $user = User::where('email', $credentials['email'])->first();
            if ($user) {
                if ($user->id == 1) { // For ADMIN
                    if (Auth::attempt($credentials)) {
                        $request->session()->regenerate();
                        return redirect()->intended('admin/dashboard');
                    } else {
                        return back()->withErrors([
                            'email' => 'The provided credentials do not match our records.',
                        ])->onlyInput('email');
                    }
                } else {
                    if ($user?->employee?->status == 'active') { // For checking employee's status is active or not
                        if (Auth::attempt($credentials)) {
                            $request->session()->regenerate();
                            return redirect()->intended('admin/dashboard');
                        } else {
                            return back()->withErrors([
                                'email' => 'The provided credentials do not match our records.',
                            ])->onlyInput('email');
                        }
                    } else {
                        return back()->withErrors([
                            'email' => 'Your account is deactivated.',
                        ])->onlyInput('email');
                    }
                }
            } else {
                return back()->withErrors([
                    'email' => 'The provided credentials do not match our records.',
                ])->onlyInput('email');
            }

            // if (Auth::attempt($credentials)) {
            //     // return auth()->user();
            //     if (auth()->user()->is_active) {
            //         $request->session()->regenerate();
            //         // $request->authenticate();

            //         $request->session()->regenerate();

            //         // return redirect()->intended(RouteServiceProvider::HOME);
            //         return redirect()->intended('admin/dashboard');
            //     } else {
            //         return back()->withErrors([
            //             'email' => 'You Account is deactived',
            //         ])->onlyInput('email');
            //     }
            // }

            // return back()->withErrors([
            //     'email' => 'The provided credentials do not match our records.',
            // ])->onlyInput('email');
        } else {
            return redirect()->intended('admin/dashboard');
        }

        // if ($request->isMethod('post')) {
        //     $credentials = $request->validate([
        //         'email' => ['required', 'email'],
        //         'password' => ['required'],
        //     ]);

        //     $remember = $request->has('remember');

        //     if (Auth::attempt($credentials, $remember)) {
        //         $request->session()->regenerate();

        //         return redirect()->intended('admin/dashboard');
        //     }

        //     return back()->withErrors([
        //         'email' => 'The provided credentials do not match our records.',
        //     ])->onlyInput('email');
        // }

        // return redirect()->intended('admin/dashboard');


    }
}
