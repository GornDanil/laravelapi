<?php

namespace App\Repositories\Authentication\Abstracts;

use Illuminate\Pagination\LengthAwarePaginator;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Interface UserRepositoryInterface.
 *
 * @package namespace App\Repositories;
 */
interface UserRepositoryInterface extends RepositoryInterface
{
    /**
     * @param $user
     * @return LengthAwarePaginator
     * @throws RepositoryException
     */
    public function userWorker($user): LengthAwarePaginator;
}
