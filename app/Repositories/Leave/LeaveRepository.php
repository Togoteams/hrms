<?php
namespace App\Repositories\Leave;

use App\Models\Leave;
use App\Contracts\Leave\LeaveContract;
use App\Models\Category;
use App\Repositories\BaseRepository;
/**
 * Class PageRepository
 *
 * @package \App\Repositories
 */
class LeaveRepository extends BaseRepository implements LeaveContract
{
    protected $leaveModel;
    /**
     * LeaveRepository constructor
     *
     * @param Leave $model
     */
    /**
     * LeaveRepository constructor
     *
     *
     */
    public function __construct(Leave $model)
    {
        parent::__construct($model);
        $this->model = $model;

    }

    /**
     * List of all Leaves
     *
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listLeaves($filterConditions,string $order = 'id', string $sort = 'desc',$limit= null,$inRandomOrder= false){
        $leaves = $this->model->where($filterConditions);
        if (!is_null($limit)) {
            return $leaves->paginate($limit);
        }
        return $leaves->get();
    }

    /**
     * Find a Leave with id
     *
     * @param int $id
     */
    public function findLeaveById(int $id){
        return $this->find($id);
    }

    /**
     * Create a Leave
     *
     * @param array $attributes
     * @return Leave|mixed
     */
    public function createLeave($attributes){
        // $attributes['created_by'] = auth()->user()->id;
        // $attributes['updated_by'] = auth()->user()->id;
        $isLeaveCreated= $this->create($attributes);
        // if($isLeaveCreated){
           
        // }
        return $isLeaveCreated;
    }

    /**
     *  Update a Leave
     *
     * @param array $attributes
     * @param int $id
     * @return Leave|mixed
     */
    public function updateLeave($attributes, $id){
        $Leave= $this->find($id);
        // $attributes['created_by'] = auth()->user()->id;
        // $attributes['updated_by'] = auth()->user()->id;
        $isLeaveUpdated= $Leave->update($attributes);
        if($isLeaveUpdated){
           
        }
        return $isLeaveUpdated;
    }

    /**
     * Delete a Leave
     *
     * @param int $id
     * @return bool|mixed
     */
    public function deleteLeave($id){
        return $this->delete($id);
    }

    /**
     * Update a Leave's status
     *
     * @param array $params
     * @param int $id
     * @return mixed
     */
    public function setLeaveStatus($attributes, $id){
        return $this->update($attributes, $id);
    }
}
