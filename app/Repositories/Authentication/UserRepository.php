<?php

namespace App\Repositories\Authentication;

use App\Models\User;
use App\Repositories\Authentication\Abstracts\UserRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

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
    public function userWorker($user): ?Collection
    {
        $query = $this->makeModel();
            return $query->select('id', 'login', 'name', 'email', 'about'
            )->where('departments_id', $user->departments_id)->get();

    }
}
