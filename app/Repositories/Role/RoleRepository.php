<?php
namespace App\Repositories\Role;

use App\Models\Role;
use App\Contracts\Role\RoleContract;
use App\Models\Category;
use App\Models\Permission;
use App\Repositories\BaseRepository;
/**
 * Class PageRepository
 *
 * @package \App\Repositories
 */
class RoleRepository extends BaseRepository implements RoleContract
{
    protected $categoryModel;
    protected $permissionModel;
    /**
     * RoleRepository constructor
     *
     * @param Role $model
     * @param Category $categoryModel
     */
    /**
     * RoleRepository constructor
     *
     *
     */
    public function __construct(Role $model,Permission $permissionModel)
    {
        parent::__construct($model);
        $this->model = $model;
        $this->permissionModel= $permissionModel;

    }

    /**
     * List of all Roles
     *
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listRoles($filterConditions,string $order = 'id', string $sort = 'desc',$limit= null,$inRandomOrder= false){
        $roles = $this->model->where($filterConditions);
        if (!is_null($limit)) {
            return $roles->paginate($limit);
        }
        return $roles->get();
    }

    /**
     * Find a Role with id
     *
     * @param int $id
     */
    public function findRoleById(int $id){
        return $this->find($id);
    }

    /**
     * Create a Role
     *
     * @param array $attributes
     * @return Role|mixed
     */
    public function createRole($attributes){
        // $attributes['created_by'] = auth()->user()->id;
        // $attributes['updated_by'] = auth()->user()->id;
        $isRoleCreated= $this->create($attributes);
        // if($isRoleCreated){
           
        // }
        return $isRoleCreated;
    }

    /**
     *  Update a Role
     *
     * @param array $attributes
     * @param int $id
     * @return Role|mixed
     */
    public function updateRole($attributes, $id){
        $role= $this->find($id);
        // $attributes['created_by'] = auth()->user()->id;
        // $attributes['updated_by'] = auth()->user()->id;
        $isRoleUpdated= $role->update($attributes);
        if($isRoleUpdated){
           
        }
        return $isRoleUpdated;
    }

    /**
     * Delete a Role
     *
     * @param int $id
     * @return bool|mixed
     */
    public function deleteRole($id){
        return $this->delete($id);
    }

    /**
     * Update a Role's status
     *
     * @param array $params
     * @param int $id
     * @return mixed
     */
    public function setRoleStatus($attributes, $id){
        return $this->update($attributes, $id);
    }
    public function getAllPermissions(){
        return $this->permissionModel->NotDashboard()->get();
    }
}
