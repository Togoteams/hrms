<?php

namespace App\Services\User;

use Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Repositories\User\UserRepository;
use App\Contracts\User\UserContract;

class UserService
{
    /**
     * @var UserContract
     */
    protected $userRepository;

    /**
     * UserService constructor
     */
    public function __construct(UserContract $userRepository)
    {
        $this->userRepository              = $userRepository;
    }

    /**
     * Find user by id
     *
     * @param int $id
     * @return mixed
     */
    public function findUser(int $id)
    {
        return $this->userRepository->find($id);
    }

    public function findUserBy(array $where)
    {
        return $this->userRepository->findOneBy($where);
    }

    public function createUser($attributes)
    {
        $isUserCreated = $this->createUser($attributes);
        return $isUserCreated;
    }
    public function updateUser($attributes, $id)
    {
        $user = $this->find($id);
        $isUserUpdated = $this->updateUser($attributes, $id);
        return $user;
    }

    

    /**
     * Fetch list of users by user ids
     *
     * @param array $userIds
     * @param array $columns
     * @return mixed
     */
    public function findUserByIds(array $userIds, array $columns)
    {
        return $this->userRepository->findUserByIds($userIds, $columns);
    }

    /**
     * Find list of users based on certain condition
     *
     * @param $profileType
     * @param null $filterConditions
     * @param int $status
     * @param string $sortBy
     * @param null $limit
     * @return mixed
     */
    public function findUsers(
        $profileType,
        $filterConditions = null,
        $orderBy = 'id',
        $sortBy = 'asc',
        $limit = null,
        $inRandomOrder = false
    ) {
        return $this->userRepository->findUsers($profileType, $filterConditions, $orderBy, $sortBy, $limit, $inRandomOrder);
    }

    /**
     * Find list of users for frontend based on certain condition
     *
     * @param $profileType
     * @param null $filterConditions
     * @param int $status
     * @param string $sortBy
     * @param null $limit
     * @return mixed
     */
    public function userSearch(
        $profileType,
        $filterConditions = null,
        $orderBy = 'id',
        $sortBy = 'asc',
        $limit = null,
        $inRandomOrder = false
    ) {
        return $this->userRepository->userSearch($profileType, $filterConditions, $orderBy, $sortBy, $limit, $inRandomOrder);
    }

    public function validatePassword(string $password, int $userId)
    {
        $currentHashedPassword = $this->userRepository->find($userId)->password;
        return Hash::check($password, $currentHashedPassword);
    }

    public function deleteUser($id){
        $user=$this->userRepository->find($id);
        $isUserDeleted= $user->delete($id);
       
        return $isUserDeleted;
    }
    public function updateStatus(array $attributes,$id){
        $attributes['value'] == '1' ? 1 : 0;
        return $this->userRepository->updateUser($attributes, $id);
    }

}
