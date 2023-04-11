<?php

namespace App\Services\Leave;

use App\Contracts\Leave\LeaveContract;
class LeaveService
{
    /**
     * @var LeaveContract
     */
    protected $leaveRepository;

    /**
     * LeaveService constructor
     */
    public function __construct(LeaveContract $leaveRepository)
    {
        $this->leaveRepository              = $leaveRepository;
    }

    public function listLeaves(array $filterConditions, string $orderBy = 'id', $sortBy = 'asc', $limit = null, $inRandomOrder = false)
    {
        return $this->leaveRepository->listLeaves($filterConditions, $orderBy, $sortBy, $limit);
    }

    /**
     * Find Leave by id
     *
     * @param int $id
     * @return mixed
     */
    public function findLeave(int $id)
    {
        return $this->leaveRepository->find($id);
    }

    public function deleteLeave($id){
        $Leave=$this->leaveRepository->find($id);
        $isLeaveDeleted= $Leave->delete($id);
       
        return $isLeaveDeleted;
      }
    

  
    public function createOrUpdateLeave(array $attributes, $id = null){
        if (is_null($id)) {
            return $this->leaveRepository->createLeave($attributes);
        } else {
            return $this->leaveRepository->updateLeave($attributes, $id);
        }
    }
    public function updateStatus(array $attributes,$id){
        $attributes['value'] == '1' ? 1 : 0;
        return $this->leaveRepository->updateLeave($attributes, $id);
    }

    

    /**
     * Fetch list of Leaves by Leave ids
     *
     * @param array $LeaveIds
     * @param array $columns
     * @return mixed
     */
    public function findLeaveByIds(array $LeaveIds, array $columns)
    {
        return $this->leaveRepository->findLeaveByIds($LeaveIds, $columns);
    }

    /**
     * Find list of Leaves based on certain condition
     *
     * @param $profileType
     * @param null $filterConditions
     * @param int $status
     * @param string $sortBy
     * @param null $limit
     * @return mixed
     */
    public function findLeaves(
        $profileType,
        $filterConditions = null,
        $orderBy = 'id',
        $sortBy = 'asc',
        $limit = null,
        $inRandomOrder = false
    ) {
        return $this->leaveRepository->findLeaves($profileType, $filterConditions, $orderBy, $sortBy, $limit, $inRandomOrder);
    }

    /**
     * Find list of Leaves for frontend based on certain condition
     *
     * @param $profileType
     * @param null $filterConditions
     * @param int $status
     * @param string $sortBy
     * @param null $limit
     * @return mixed
     */
    public function LeaveSearch(
        $profileType,
        $filterConditions = null,
        $orderBy = 'id',
        $sortBy = 'asc',
        $limit = null,
        $inRandomOrder = false
    ) {
        return $this->leaveRepository->LeaveSearch($profileType, $filterConditions, $orderBy, $sortBy, $limit, $inRandomOrder);
    }

   

}
