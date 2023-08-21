<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //

    public function viewDashboard()
    {
        $data = User::findOrFail(Auth::user()->id);
        // dd($data);
        return view('dashboard', compact('data'));
    }

    public function userManualDownload($filename)
    {
        // Logic to determine the file path based on the filename
        $file = storage_path('app/public/user_manual/' . $filename);

        if (file_exists($file)) {
            // Prepare the file response
            return response()->download($file);
        } else {
            // File not found response
            abort(404);
        }
    }
}
