<?php

namespace App\Repositories\Authentication;

use App\Models\User;
use App\Repositories\Authentication\Abstracts\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Prettus\Repository\Eloquent\BaseRepository;

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
        return $query->select(['id', 'login', 'name', 'email', 'about', 'departments_id','workers_id'
        ])->with(['workPosition', 'departmentName'])->where('departments_id', $user->departments_id)->paginate(10);

    }
}
