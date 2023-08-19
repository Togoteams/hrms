<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveSetting;
use Illuminate\Http\Request;

class LeaveSettingController extends Controller
{
    public $page_name = "Leave Settings";
    public function index()
    {
        // $data =  LeaveSetting::orderByDesc('id')->get();
        return view('admin.leave_setting.index', ['page' => $this->page_name]);
    }
}
