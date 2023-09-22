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
use App\Http\Resources\Leave\LeaveResource;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Document;
use App\Models\Holiday;
use App\Models\MedicalCard;
use App\Models\PayrollSalaryIncrement;
use App\Models\ReimbursementType;

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
    protected $leaveService;
    public function __construct(
        RoleService $roleService,
        UserService $userService,
        HolidayService $holidayService,
        LeaveService $leaveService,

        )
    {
        $this->roleService = $roleService;
        $this->userService = $userService;
        $this->holidayService = $holidayService;
        $this->leaveService = $leaveService;

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
                    $leave= $this->leaveService->findLeave($id);
                    $data = new LeaveResource($leave);
                    $message='Leave data fetched';
                    break;
                case 'users':
                    $id = uuidtoid($request->uuid, $table);
                    $leave= $this->userService->findUser($id);
                    $data = new UserResource($leave);
                    $message='User data fetched';
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
                    // $request->merge($data);
                    // dd($request->all());
                    $id = uuidtoid($request->uuid, $table);
                    $data= $this->userService->updateStatus($request->except('find'),$id);
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
                case 'payroll_salary_increments':
                    $id = $request->uuid;
                    $data= PayrollSalaryIncrement::where('id',$id)->update([
                        "status"=>$request->value
                    ]);
                    $message='Payroll Salary increment updated';
                    break;
                case 'designations':
                        $id = $request->uuid;
                        $data= Designation::where('id',$id)->update([
                            "status"=>$request->value
                        ]);
                        $message='Designation Status updated';
                        break;
                case 'documents':
                    $id = $request->uuid;
                    $data= Document::where('id',$id)->update([
                        "status"=>$request->value
                    ]);
                    $message='Designation Status updated';
                    break;
               
                case 'reimbursement_types':
                    $id = $request->uuid;
                    $data= ReimbursementType::where('id',$id)->update([
                        "status"=>$request->value
                    ]);
                    $message='Reimbursement Status updated';
                    break;
                
                case 'department':
                    $id = $request->uuid;
                    $data= Department::where('id',$id)->update([
                        "status"=>$request->value
                    ]);
                    $message='Department Status updated';
                    break;
                case 'medical-card':
                    $id = $request->uuid;
                    $data= MedicalCard::where('id',$id)->update([
                        "status"=>$request->value
                    ]);
                    $message='MedicalCard Status updated';
                    break;
                case 'holidays':
                    $id = $request->uuid;
                    $data= Holiday::where('id',$id)->update([
                        "status"=>$request->value
                    ]);
                    $message='Holiday Status updated';
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
                    $data= $this->leaveService->deleteLeave($id);
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
