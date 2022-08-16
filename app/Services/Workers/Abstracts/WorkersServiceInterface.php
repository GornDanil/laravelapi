<?php

namespace App\Services\Workers\Abstracts;

use App\Domain\DTO\UpdateUserDTO;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Pagination\LengthAwarePaginator;
use Prettus\Repository\Exceptions\RepositoryException;
use Symfony\Component\HttpFoundation\Response;

interface WorkersServiceInterface
{
    /**
     * @param User $user
     * @throws RepositoryException
     * @throws Exception
     * @return LengthAwarePaginator<User>
     */
    public function workers(User $user): LengthAwarePaginator;

    /**
     * @param int $user
     * @return User|null
     */
    public function showUserWorker(int $user): ?User;

    /**
     * @param ?User $user
     * @param UpdateUserDTO $updateUserDTO
     * @return void
     */
    public function updateUser(?User $user, UpdateUserDTO $updateUserDTO): void;
}
