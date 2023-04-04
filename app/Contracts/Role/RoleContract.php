<?php

namespace App\Contracts\Role;

/**
 * Interface PageContract
 * @package App\Contracts
 */
interface RoleContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listRoles(array $filterConditions,string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */

    public function findRoleById(int $id);

    /**
     * @param $slug
     * @return mixed
     */

    /**
     * @param array $params
     * @return mixed
     */
    public function createRole(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateRole(array $params,string $id);

    /**
     * @param $id
     * @return bool
     */
    public function deleteRole($id);

   
}
