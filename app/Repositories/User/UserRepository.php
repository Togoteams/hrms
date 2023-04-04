<?php
namespace App\Repositories\User;

use App\Models\User;
use App\Contracts\User\UserContract;
use App\Models\Category;
use App\Repositories\BaseRepository;
/**
 * Class PageRepository
 *
 * @package \App\Repositories
 */
class UserRepository extends BaseRepository implements UserContract
{
    /**
     * UserRepository constructor
     *
     * @param User $model
     */
    /**
     * UserRepository constructor
     *
     *
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
        $this->model = $model;

    }

    /**
     * List of all Users
     *
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listUsers($filterConditions,string $order = 'id', string $sort = 'desc',$limit= null,$inRandomOrder= false){
        $users = $this->model->where($filterConditions);
        if (!is_null($limit)) {
            return $users->paginate($limit);
        }
        return $users->get();
    }

    /**
     * Find a User with id
     *
     * @param int $id
     */
    public function findUserById(int $id){
        return $this->find($id);
    }

    /**
     * Create a User
     *
     * @param array $attributes
     * @return User|mixed
     */
    public function createUser($attributes){
        // $attributes['created_by'] = auth()->user()->id;
        // $attributes['updated_by'] = auth()->user()->id;
        $isUserCreated= $this->create($attributes);
        if($isUserCreated){
           
        }
        return $isUserCreated;
    }

    /**
     *  Update a User
     *
     * @param array $attributes
     * @param int $id
     * @return User|mixed
     */
    public function updateUser($attributes, $id){
        $User= $this->find($id);
        // $attributes['created_by'] = auth()->user()->id;
        // $attributes['updated_by'] = auth()->user()->id;
        $isUserUpdated= $User->update($attributes);
        if($isUserUpdated){
           
        }
        return $isUserUpdated;
    }

    /**
     * Delete a User
     *
     * @param int $id
     * @return bool|mixed
     */
    public function deleteUser($id){
        return $this->delete($id);
    }

    /**
     * Update a User's status
     *
     * @param array $params
     * @param int $id
     * @return mixed
     */
    public function setUserStatus($attributes, $id){
        return $this->update($attributes, $id);
    }
}
