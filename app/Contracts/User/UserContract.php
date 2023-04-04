<?php

namespace App\Contracts\User;

/**
 * Interface PageContract
 * @package App\Contracts
 */
interface UserContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listUsers(array $filterConditions,string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */

    public function findUserById(int $id);

    /**
     * @param $slug
     * @return mixed
     */

    /**
     * @param array $params
     * @return mixed
     */
    public function createUser(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateUser(array $params,string $id);

    /**
     * @param $id
     * @return bool
     */
    public function deleteUser($id);

   
}
