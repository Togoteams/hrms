<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use App\Models\User;

class UserController extends BaseController
{
    protected $model;
    public function __construct(User $model) {
        $this->model            = $model;
    }
    
    public function viewUser()
    {
        $users = $this->model::get();
        return view('admin.user.users', compact('users'));
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
            'name'     =>  'required|string',
            'short_code' => 'required|min:3|string',
            'user_type' => 'required|min:3|string',
        ]);

        $data = [
            'name' => $request->name,
            'short_code' => $request->short_code,
            'User_type' => $request->User_type,
            'description' => $request->description,
            'status' => $request->status,
        ];

        $isUserCreated = $this->model::updateOrCreate(['id' => $userId], $data);
        if ($isUserCreated) {
            return   $this->sendResponse($isUserCreated, $message);
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
                    return $this->sendResponse('admin.users.user', $message);
                }
            } else {
                $message = 'User not found';
                return $this->sendResponse('admin.users.user', $message);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return   $this->sendError($e->getMessage());
            logger($e->getMessage() . ' -- ' . $e->getLine() . ' -- ' . $e->getFile());
        }
    }
}
