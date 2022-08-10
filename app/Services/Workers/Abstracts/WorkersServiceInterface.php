<?php

namespace App\Services\Workers\Abstracts;

use Prettus\Repository\Exceptions\RepositoryException;

interface WorkersServiceInterface
{
    /**
     * @param object $user
     * @throws RepositoryException
     */
    public function workers(object $user);

    /**
     * @param int $user
     * @return object|null
     */
    public function showUserWorker(int $user): ?object;

    /**
     * @param $user
     * @param $updateUserDTO
     * @return mixed
     */
    public function updateUser($user, $updateUserDTO);
}
