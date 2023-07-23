<?php

namespace App\Services\Role;

use Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Role\RoleRepository;
use App\Contracts\Role\RoleContract;
class RoleService
{
    /**
     * @var RoleContract
     */
    protected $roleRepository;

    /**
     * RoleService constructor
     */
    public function __construct(RoleContract $roleRepository)
    {
        $this->roleRepository              = $roleRepository;
    }

    public function listRoles(array $filterConditions, string $orderBy = 'id', $sortBy = 'asc', $limit = null, $inRandomOrder = false)
    {
        return $this->roleRepository->listRoles($filterConditions, $orderBy, $sortBy, $limit);
    }

    /**
     * Find Role by id
     *
     * @param int $id
     * @return mixed
     */
    public function findRole(int $id)
    {
        return $this->roleRepository->find($id);
    }
    public function getAllPermissions()
    {
        return $this->roleRepository->getAllPermissions();
    }   

    public function deleteRole($id){
        $role=$this->roleRepository->find($id);
        $isRoleDeleted= $role->delete($id);
       
        return $isRoleDeleted;
      }
    

  
    public function createOrUpdateRole(array $attributes, $id = null){
        if (is_null($id)) {
            return $this->roleRepository->createRole($attributes);
        } else {
            return $this->roleRepository->updateRole($attributes, $id);
        }
    }
    public function updateStatus(array $attributes,$id){
        if( $attributes['value']=="active")
        {
            $attributes['status'] ="inactive";
        }else
        {
            $attributes['status'] ="active";
        }
        // dd( $attributes['value']);
        return $this->roleRepository->updateRole($attributes, $id);
    }

    

    /**
     * Fetch list of Roles by Role ids
     *
     * @param array $roleIds
     * @param array $columns
     * @return mixed
     */
    public function findRoleByIds(array $roleIds, array $columns)
    {
        return $this->roleRepository->findRoleByIds($roleIds, $columns);
    }

    /**
     * Find list of Roles based on certain condition
     *
     * @param $profileType
     * @param null $filterConditions
     * @param int $status
     * @param string $sortBy
     * @param null $limit
     * @return mixed
     */
    public function findRoles(
        $profileType,
        $filterConditions = null,
        $orderBy = 'id',
        $sortBy = 'asc',
        $limit = null,
        $inRandomOrder = false
    ) {
        return $this->roleRepository->findRoles($profileType, $filterConditions, $orderBy, $sortBy, $limit, $inRandomOrder);
    }

    /**
     * Find list of Roles for frontend based on certain condition
     *
     * @param $profileType
     * @param null $filterConditions
     * @param int $status
     * @param string $sortBy
     * @param null $limit
     * @return mixed
     */
    public function RoleSearch(
        $profileType,
        $filterConditions = null,
        $orderBy = 'id',
        $sortBy = 'asc',
        $limit = null,
        $inRandomOrder = false
    ) {
        return $this->roleRepository->RoleSearch($profileType, $filterConditions, $orderBy, $sortBy, $limit, $inRandomOrder);
    }

   

}
