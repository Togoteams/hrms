<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public $page_name = "Membership";

    public function index()
    {
        return view('admin.setting.index', ['page' => $this->page_name]);
    }
}
