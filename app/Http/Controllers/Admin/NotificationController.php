<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;


class NotificationController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public $page_name = "Notification";

    public function index(Request $request)
    { 
        if ($request->ajax()) {
            $data = Notification::where('user_id',auth()->user()->id)->get();
            return DataTables::of($data)
                ->addIndexColumn()              
                ->make(true);
            }
        return view('admin.notification.index', ['page' => $this->page_name]);

    }
}
