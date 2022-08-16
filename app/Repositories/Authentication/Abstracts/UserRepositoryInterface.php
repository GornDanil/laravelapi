<?php

namespace App\Repositories\Authentication\Abstracts;

use App\Domain\DTO\UpdateUserDTO;
use App\Models\User;
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
     * @param object $user
     * @return LengthAwarePaginator<User>
     * @throws RepositoryExceptionreturn parent::toArray($request);
     */
    public function userWorker(object $user): LengthAwarePaginator;

    /**
     * @param int $user
     * @return User
     * @throws RepositoryException
     */
    public function user(int $user): User;

    /**
     * @param int $user
     * @return User|null
     * @throws RepositoryException
     */
    public function userCard(int $user): ?User;

    /**
     * @param User $user
     * @param UpdateUserDTO $updateUserDTO
     * @return void
     */
    public function updateUser(User $user, UpdateUserDTO $updateUserDTO): void;
}
