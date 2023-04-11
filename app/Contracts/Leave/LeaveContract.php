<?php

namespace App\Contracts\Leave;

/**
 * Interface PageContract
 * @package App\Contracts
 */
interface LeaveContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listLeaves(array $filterConditions,string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */

    public function findLeaveById(int $id);

    /**
     * @param $slug
     * @return mixed
     */

    /**
     * @param array $params
     * @return mixed
     */
    public function createLeave(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateLeave(array $params,string $id);

    /**
     * @param $id
     * @return bool
     */
    public function deleteLeave($id);

   
}
