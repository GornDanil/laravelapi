<?php

namespace App\Repositories\Authentication;

use App\Models\User;
use App\Repositories\Authentication\Abstracts\UserRepositoryInterface;
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
    public function model()
    {
        return User::class;
    }

    public function userWorker($user)
    {
        $query = $this->makeModel();
        if ($user->role_type == 'worker') {
            return $query->select('id', 'login', 'name', 'email', 'about'
            )->where('departments_id', $user->departments_id)->get();
        }
    }
}
