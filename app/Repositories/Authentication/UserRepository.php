<?php

namespace App\Repositories\Authentication;

use App\Models\User;
use App\Repositories\Authentication\Abstracts\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class UserRepositoryInterfaceEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }

    /**
     * @inheritDoc
     */
    public function userWorker($user): LengthAwarePaginator
    {
        $query = $this->makeModel();
        return $query->select(['id', 'login', 'name', 'email', 'about', 'departments_id', 'workers_id'
        ])->with(['workPosition', 'departmentName'])->where('departments_id', $user->departments_id)->paginate(10);

    }

    /** @inheritDoc */
    public function userCard(int $user): User
    {
        $query = $this->makeModel();
        return $query->where('id', $user)->select(['id', 'login', 'name', 'email', 'about', 'role_type', 'city', 'phone', 'birthday'])->first();
    }

    /**
     * @param $user
     * @return User
     * @throws RepositoryException
     */
    public function user($user): User
    {
        $query = $this->makeModel();
        return $query->where('id', $user)->with(['workPosition', 'departmentName'])->first();
    }
}
