<?php

namespace App\Services\Workers\Abstracts;

use App\Domain\DTO\ImageUploadDTO;
use App\Domain\DTO\UpdateUserDTO;
use App\Models\Image;
use App\Models\User;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Prettus\Repository\Exceptions\RepositoryException;

interface WorkersServiceInterface
{
    /**
     * @param User|null $user
     * @return LengthAwarePaginator
     * @throws RepositoryException
     */
    public function workers(?User $user): LengthAwarePaginator;

    /**
     * @param int $user
     * @return User|null
     */
    public function showUserWorker(int $user): ?User;

    /**
     * @param User|null $user
     * @param UpdateUserDTO $updateUserDTO
     * @return void
     */
    public function updateUser(?User $user, UpdateUserDTO $updateUserDTO): void;

    /**
     * @param int $user
     * @param int $id
     * @return void
     */
    public function updateImages(int $user,int $id): void;

    /**
     * @param User $user
     * @param ImageUploadDTO $imageDTO
     * @return Image|null
     */
    public function uploadImages(User $user, ImageUploadDTO $imageDTO): ?Image;
}
