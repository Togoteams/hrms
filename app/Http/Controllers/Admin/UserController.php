<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use App\Models\Department;
use App\Models\EmpDepartmentHistory;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Hash;
class UserController extends BaseController
{
    protected $model;
    public function __construct(User $model) {
        $this->model            = $model;
    }
    
    public function viewUser()
    {  
        $users = User::with('latestDepartmentHistory')->whereHas('usersRoles',function($q){
            return $q->whereNotIn('role_id',[1]);
        })->get();

        $employees = Employee::get(); 
        $roles = Role::where('role_type','!=','superadmin')->get();
        return view('admin.user.users', compact('users','roles','employees'));
    }

    public function addUser(Request $request)
    {
        $userId = $request->user_id ?? NULL;
        if (!empty($userId)) {
            $message = "User  Updated Successfully";
        } else {
            $message = "User Created Successfully";
        }
        
        $request->validate([
            // 'name'     =>  'required|string',
            'first_name'     =>  'required|string',
            'role_id'     =>  'required|exists:roles,id',
            'email' => 'required|min:3|string|unique:users,email,'.$userId,
            'mobile' => 'required|min:3|string|unique:users,mobile,'.$userId,
            'password'=>'required|min:8|string',
            'confirm_password'=>'required|min:8|string|same:password',
        ]);
        $request->merge(['name'=>$request->first_name." ".$request->last_name]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
        ];
        $isUserCreated = $this->model::updateOrCreate(['id' => $userId], $data);
        if ($isUserCreated) {
            $isUserCreated->roles()->sync($request->role_id);
            return   $this->responseJson(true,200, $message,$isUserCreated);
        }
    }

    public function deleteUser($userId)
    {
        DB::beginTransaction();
        try {
            $user = $this->model::find($userId);
            if (!empty($user)) {
                $isUserDeleted = $user->delete();
                if ($isUserDeleted) {
                    DB::commit();
                    $message = 'User deleted successfully';
                    return $this->responseJson(true,200, $message,$isUserDeleted);
                }
            } else {
                $message = 'User not found';
                return $this->responseJson(false,200, $message);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return   $this->sendError($e->getMessage());
            logger($e->getMessage() . ' -- ' . $e->getLine() . ' -- ' . $e->getFile());
        }
    }
}
