<?php

namespace App\Services\Workers\Abstracts;

use App\Domain\DTO\ImageUploadDTO;
use App\Domain\DTO\UpdateUserDTO;
use App\Models\User;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Prettus\Repository\Exceptions\RepositoryException;

interface WorkersServiceInterface
{
    /**
     * @param ?User $user
     * @return LengthAwarePaginator<User>
     * @throws Exception
     * @throws RepositoryException
     */
    public function workers(?User $user): LengthAwarePaginator;

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

    /**
     * @param User $user
     * @param ImageUploadDTO $imageDTO
     * @return void
     */
    public function updateImages(User $user, ImageUploadDTO $imageDTO): void;
}
