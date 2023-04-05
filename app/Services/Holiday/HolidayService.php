<?php

namespace App\Services\Holiday;

use App\Contracts\Holiday\HolidayContract;
class HolidayService
{
    /**
     * @var HolidayContract
     */
    protected $holidayRepository;

    /**
     * HolidayService constructor
     */
    public function __construct(HolidayContract $holidayRepository)
    {
        $this->holidayRepository              = $holidayRepository;
    }

    public function listHolidays(array $filterConditions, string $orderBy = 'id', $sortBy = 'asc', $limit = null, $inRandomOrder = false)
    {
        return $this->holidayRepository->listHolidays($filterConditions, $orderBy, $sortBy, $limit);
    }

    /**
     * Find Holiday by id
     *
     * @param int $id
     * @return mixed
     */
    public function findHoliday(int $id)
    {
        return $this->holidayRepository->find($id);
    }

    public function deleteHoliday($id){
        $Holiday=$this->holidayRepository->find($id);
        $isHolidayDeleted= $Holiday->delete($id);
       
        return $isHolidayDeleted;
      }
    

  
    public function createOrUpdateHoliday(array $attributes, $id = null){
        if (is_null($id)) {
            return $this->holidayRepository->createHoliday($attributes);
        } else {
            return $this->holidayRepository->updateHoliday($attributes, $id);
        }
    }
    public function updateStatus(array $attributes,$id){
        $attributes['value'] == '1' ? 1 : 0;
        return $this->holidayRepository->updateHoliday($attributes, $id);
    }

    

    /**
     * Fetch list of Holidays by Holiday ids
     *
     * @param array $HolidayIds
     * @param array $columns
     * @return mixed
     */
    public function findHolidayByIds(array $HolidayIds, array $columns)
    {
        return $this->holidayRepository->findHolidayByIds($HolidayIds, $columns);
    }

    /**
     * Find list of Holidays based on certain condition
     *
     * @param $profileType
     * @param null $filterConditions
     * @param int $status
     * @param string $sortBy
     * @param null $limit
     * @return mixed
     */
    public function findHolidays(
        $profileType,
        $filterConditions = null,
        $orderBy = 'id',
        $sortBy = 'asc',
        $limit = null,
        $inRandomOrder = false
    ) {
        return $this->holidayRepository->findHolidays($profileType, $filterConditions, $orderBy, $sortBy, $limit, $inRandomOrder);
    }

    /**
     * Find list of Holidays for frontend based on certain condition
     *
     * @param $profileType
     * @param null $filterConditions
     * @param int $status
     * @param string $sortBy
     * @param null $limit
     * @return mixed
     */
    public function HolidaySearch(
        $profileType,
        $filterConditions = null,
        $orderBy = 'id',
        $sortBy = 'asc',
        $limit = null,
        $inRandomOrder = false
    ) {
        return $this->holidayRepository->HolidaySearch($profileType, $filterConditions, $orderBy, $sortBy, $limit, $inRandomOrder);
    }

   

}
