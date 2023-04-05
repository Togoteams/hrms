<?php

namespace App\Contracts\Holiday;

/**
 * Interface PageContract
 * @package App\Contracts
 */
interface HolidayContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listHolidays(array $filterConditions,string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */

    public function findHolidayById(int $id);

    /**
     * @param $slug
     * @return mixed
     */

    /**
     * @param array $params
     * @return mixed
     */
    public function createHoliday(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateHoliday(array $params,string $id);

    /**
     * @param $id
     * @return bool
     */
    public function deleteHoliday($id);

   
}
