<?php

namespace App\Services\Workers\Abstracts;

use App\Domain\DTO\UpdateUserDTO;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Prettus\Repository\Exceptions\RepositoryException;
use Symfony\Component\HttpFoundation\Response;

interface WorkersServiceInterface
{
    /**
     * @param object $user
     * @throws RepositoryException
     * @return LengthAwarePaginator|Response
     */
    public function workers(object $user): LengthAwarePaginator|Response;

    /**
     * @param int $user
     * @return object|null
     */
    public function showUserWorker(int $user): ?object;

    /**
     * @param User $user
     * @param UpdateUserDTO $updateUserDTO
     * @return Response
     */
    public function updateUser(User $user, UpdateUserDTO $updateUserDTO): Response;
}
