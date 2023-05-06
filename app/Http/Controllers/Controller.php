<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Models\LeaveApply;
use App\Models\LeaveType;
use App\Models\Employee;
use App\Models\LeaveEncashment;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    function slider_url()
    {
        return "lol";
    }

    function insert_image($image, $folder)
    {
        $destinationPath = 'upload/' . $folder . '/';
        $image_name = date('YmdHis') . $image->getClientOriginalName();
        $image->move($destinationPath, $image_name);
        return $image_name;
    }
    function update_images($table_name, $id, $image, $folder, $column_name = "image")
    {
        $destinationPath = 'upload/' . $folder . '/';
        $image_name = DB::table($table_name)->find($id);
        if ($image_name->$column_name == '') {
            $image_name = date('YmdHis')  . $image->getClientOriginalName();
            DB::table($table_name)->where('id', $id)->update([$column_name => $image_name]);
        } else {
            $image_name = $image_name->$column_name;
        }
        $image->move($destinationPath, $image_name);
    }

    public function web_url()
    {
        return "web.url.com";
    }

    function total_remaining_leave($user_id = '')
    {
        if ($user_id == '') {
            // for autheticated user
            $user_id = auth()->user()->id;
        }
        $total_leave_days = LeaveType::where('status', 'active')->where('leave_for', Employee::where('user_id', $user_id)->first()->employment_type ?? '')->where('nature_of_leave', 'unpaid')->sum('no_of_days');

        $total_upaid_leave = LeaveApply::where('user_id', $user_id)->where('status', 'approved')->where('is_paid', 'unpaid')->count('*');
        $total_encash_leave = LeaveEncashment::where('user_id', $user_id)->where('status', 'approved')->where('created_at', 'LIKE', '%' . date('Y') . '%')->sum('no_of_days');
        $total_remaining_leave = $total_leave_days - $total_upaid_leave - $total_encash_leave;
        return  $total_remaining_leave;
    }
}
