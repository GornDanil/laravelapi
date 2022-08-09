<?php

namespace App\Repositories\Authentication\Abstracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepositoryInterface.
 *
 * @package namespace App\Repositories;
 */
interface UserRepositoryInterface extends RepositoryInterface
{
    public function userWorker($user);
}
