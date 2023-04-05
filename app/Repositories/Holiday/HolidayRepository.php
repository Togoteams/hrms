<?php
namespace App\Repositories\Holiday;

use App\Models\Holiday;
use App\Contracts\Holiday\HolidayContract;
use App\Models\Category;
use App\Repositories\BaseRepository;
/**
 * Class PageRepository
 *
 * @package \App\Repositories
 */
class HolidayRepository extends BaseRepository implements HolidayContract
{
    protected $holidayModel;
    /**
     * HolidayRepository constructor
     *
     * @param Holiday $model
     */
    /**
     * HolidayRepository constructor
     *
     *
     */
    public function __construct(Holiday $model)
    {
        parent::__construct($model);
        $this->model = $model;

    }

    /**
     * List of all Holidays
     *
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listHolidays($filterConditions,string $order = 'id', string $sort = 'desc',$limit= null,$inRandomOrder= false){
        $holidays = $this->model->where($filterConditions);
        if (!is_null($limit)) {
            return $holidays->paginate($limit);
        }
        return $holidays->get();
    }

    /**
     * Find a Holiday with id
     *
     * @param int $id
     */
    public function findHolidayById(int $id){
        return $this->find($id);
    }

    /**
     * Create a Holiday
     *
     * @param array $attributes
     * @return Holiday|mixed
     */
    public function createHoliday($attributes){
        // $attributes['created_by'] = auth()->user()->id;
        // $attributes['updated_by'] = auth()->user()->id;
        $isHolidayCreated= $this->create($attributes);
        // if($isHolidayCreated){
           
        // }
        return $isHolidayCreated;
    }

    /**
     *  Update a Holiday
     *
     * @param array $attributes
     * @param int $id
     * @return Holiday|mixed
     */
    public function updateHoliday($attributes, $id){
        $Holiday= $this->find($id);
        // $attributes['created_by'] = auth()->user()->id;
        // $attributes['updated_by'] = auth()->user()->id;
        $isHolidayUpdated= $Holiday->update($attributes);
        if($isHolidayUpdated){
           
        }
        return $isHolidayUpdated;
    }

    /**
     * Delete a Holiday
     *
     * @param int $id
     * @return bool|mixed
     */
    public function deleteHoliday($id){
        return $this->delete($id);
    }

    /**
     * Update a Holiday's status
     *
     * @param array $params
     * @param int $id
     * @return mixed
     */
    public function setHolidayStatus($attributes, $id){
        return $this->update($attributes, $id);
    }
}
