<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Admin\Role\RoleResource;
use App\Http\Resources\Admin\User\UserResource;
use App\Services\User\UserService;
use App\Services\Role\RoleService;
use App\Services\Holiday\HolidayService;
use App\Http\Resources\HolidayResource;
use App\Services\Leave\LeaveService;
use App\Http\Resources\LeaveResource;
class AjaxController extends BaseController
{
    /**
     * @var UserService
     */
    protected $userService;
     /**
     * @var RoleService
     */
    protected $roleService;
    protected $holidayService;
    protected $LeaveService;
    public function __construct(
        RoleService $roleService,
        UserService $userService,
        HolidayService $holidayService,
        LeaveService $LeaveService,

        )
    {
        $this->roleService = $roleService;
        $this->userService = $userService;
        $this->holidayService = $holidayService;
        $this->LeaveService = $LeaveService;

    }

    public function editData(Request $request){
        if($request->ajax()){
            $table=$request->find;
            switch($table){
                case 'users':
                    $id = uuidtoid($request->uuid, $table);
                    $user= $this->userService->findUser($id);
                    $data = new UserResource($user);
                    $message='User data fetched';
                    break; 
                case 'roles':
                    $id = uuidtoid($request->uuid, $table);
                    $role= $this->roleService->findRole($id);
                    $data= new RoleResource($role);
                    $message='Role data fetched';
                    break;
                case 'holidays':
                    $id = uuidtoid($request->uuid, $table);
                    $holiday= $this->holidayService->findHoliday($id);
                    $data = new HolidayResource($holiday);
                    $message='Holiday data fetched';
                    break;
                case 'leaves':
                    $id = uuidtoid($request->uuid, $table);
                    $leave= $this->LeaveService->findHoliday($id);
                    $data = new LeaveResource($holiday);
                    $message='Leave data fetched';
                    break;
                default:
                    return $this->responseJson(false,200,'Something Wrong Happened');
            }

            if($data){
                return $this->responseJson(true,200,$message,$data);
            }else{
                return $this->responseJson(false,200,'Something Wrong Happened');
            }

        }else{
            abort(403);
        }
    }
    public function setStatus(Request $request){
        if($request->ajax()){
            $table=$request->find;
            $data = $request->value;
            switch($table){
                case 'users':
                    $request->merge($data);
                    // dd($request->all());
                    $id = uuidtoid($request->uuid, $table);
                    $data= $this->userService->updateStatus($request->except(['uuid','find','value']),$id);
                    $message='User Status updated';
                    break;
                case 'roles':
                    $id = uuidtoid($request->uuid, $table);
                    $data= $this->roleService->updateStatus($request->except('find'),$id);
                    $message='Role Status updated';
                    break;
                case 'holidays':
                    $id = uuidtoid($request->uuid, $table);
                    $data= $this->holidayService->updateStatus($request->except('find'),$id);
                    $message='Role Status updated';
                    break;
                case 'leaves':
                    $id = uuidtoid($request->uuid, $table);
                    $data= $this->leaveService->updateStatus($request->except('find'),$id);
                    $message='Leave Status updated';
                    break;
               
                default:
                    return $this->responseJson(false,200,'Something Wrong Happened');
            }

            if($data){
                return $this->responseJson(true,200,$message);
            }else{
                return $this->responseJson(false,200,'Something Wrong Happened');
            }

        }else{
            abort(403);
        }
    }


    public function deleteData(Request $request){
        if($request->ajax()){
            $table=$request->find;
            switch($table){
                case 'users':
                    $data= $this->userService->deleteUser($request->except('find'));
                    $message='User Deleted';
                    break;
                case 'roles':
                    $id= uuidtoid($request->uuid,$table);
                    $data= $this->roleService->deleteRole($id);
                    $message='Role Deleted';
                    break;
                case 'holidays':
                    $id= uuidtoid($request->uuid,$table);
                    $data= $this->holidayService->deleteHoliday($id);
                    $message='Holiday Deleted';
                    break;
                case 'leaves':
                    $id= uuidtoid($request->uuid,$table);
                    $data= $this->leaveService->deleteHoliday($id);
                    $message='Leave Deleted';
                    break;
            }
            if($data){
                return $this->responseJson(true,200,$message);
            }else{
                return $this->responseJson(false,200,'Something Wrong Happened');
            }
        }else{
            abort(403);
        }
    }
}
