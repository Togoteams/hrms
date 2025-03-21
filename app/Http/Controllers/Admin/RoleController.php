<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use App\Models\Permission;
use App\Services\Role\RoleService;
class RoleController extends BaseController
{
    protected $roleService;
    public function __construct(RoleService $roleService)
    {
        $this->roleService= $roleService;
    }
    public function viewRole()
    {
        $filterConditions = [];
        $roles= $this->roleService->listRoles($filterConditions, 'id', 'asc');
        return view('admin.role.roles', compact('roles'));
    }

    public function addRole(Request $request)
    {
        $roleId = $request->role_id ?? NULL;
        if (!empty($roleId)) {
            $request->validate([
                'name'     =>  'required|string|unique:roles,name,'.$roleId,
                // 'short_code' => 'required|min:2|string',
                // 'role_type' => 'required|min:3|string',
            ]);
            $message = "Role  Updated Successfully";
        } else {
            $request->validate([
                'name'     =>  'required|string|unique:roles,name',
                // 'short_code' => 'required|min:2|string',
                // 'role_type' => 'required|min:3|string',
            ]);
            $message = "Role Created Successfully";
        }

     

        // dd($request->all());
        // $data = [
        //     'name' => $request->name,
        //     'short_code' => $request->short_code,
        //     'role_type' => $request->role_type,
        //     'description' => $request->description,
        //     'status' => $request->status,
        // ];
        $isRoleCreated= $this->roleService->createOrUpdateRole($request->except('_token'),$roleId);
        if ($isRoleCreated) {
            return   $this->responseJson(true,200,$message,$isRoleCreated);
        }
    }

    public function deleteRole(Request $request, $roleId)
    {
        DB::beginTransaction();
        try {
            $role = $this->model::find($roleId);
            if (!empty($role)) {
                $isRoleDeleted = $role->delete();
                if ($isRoleDeleted) {
                    DB::commit();
                    $message = 'Role  deleted successfully';
                    return $this->responseJson('admin.roles.list', $message);
                }
            } else {
                $message = 'Role  not found';
                return $this->responseJson('admin.roles.list', $message);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return   $this->sendError($e->getMessage());
            logger($e->getMessage() . ' -- ' . $e->getLine() . ' -- ' . $e->getFile());
        }
    }

    public function attachPermission(Request $request,$id)
    {
        $roleData= $this->roleService->findRole($id);
        $permissions= $this->roleService->getAllPermissions();

        $permissions= collect($permissions)->groupBy('module');
        if($request->post()){
           
            DB::begintransaction();
            try{
                $roleData->permissions()->detach();
                $isPermissionAttached= $roleData->givePermissionsTo( (array) $request->permission);
                if($isPermissionAttached){
                    DB::commit();
                    return $this->responseRedirect('admin.role.list','Permission attached successfully','success');
                }
            }catch(\Exception $e){
                DB::rollBack();
                logger($e->getMessage() . ' -- ' . $e->getLine() . ' -- ' . $e->getFile());
                return $this->responseRedirectBack('Something Went Wrong','error',true);
            }
        }

        return view('admin.role.attach-permission',compact('permissions','roleData'));

    }
}
