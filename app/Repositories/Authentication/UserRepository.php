<?php

namespace App\Repositories\Authentication;

use App\Models\User;
use App\Repositories\Authentication\Abstracts\UserRepositoryInterface;
use Illuminate\Database\Query\Builder;
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
    public function userWorker(object $user): LengthAwarePaginator
    {
        /** @var Builder $query */
        $query = $this->makeModel();

        return $query->select(['id', 'login', 'name', 'email'
        ])->where('departments_id', $user->departments_id)->paginate(10);

    }

    /**
     * @inheritDoc
     */
    public function userCard(int $user): ?User
    {
        /** @var Builder $query */
        $query = $this->makeModel();

        $query = $query->where('id', $user)
            ->select(
                ['id', 'login', 'name', 'email', 'about', 'role_type', 'city', 'phone', 'birthday']
            );

        /** @var User|null $model */
        $model = $query->first();
        return $model;
    }

    /**
     * @inheritDoc
     */
    public function user(int $user): User
    {
        /** @var Builder $query */
        $query = $this->makeModel();

        return $query->where('id', $user)->with(['workPosition', 'departmentName'])->first();
    }


}
