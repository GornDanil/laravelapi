<?php

namespace App\Repositories\Authentication\Abstracts;

use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface UserRepositoryInterface.
 *
 * @package namespace App\Repositories;
 */
interface UserRepositoryInterface extends RepositoryInterface
{
    /**
     * @param $user
     * @return Collection|null
     * @throws RepositoryException
     */
    public function userWorker($user): ?Collection;
}
