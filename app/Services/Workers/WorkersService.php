<?php

namespace App\Services\Workers;

use App\Domain\DTO\ImageUploadDTO;
use App\Domain\DTO\UpdateUserDTO;
use App\Domain\Enums\Departments\DepartmentsType;
use App\Exceptions\AccessException;
use App\Models\User;
use App\Repositories\Authentication\Abstracts\UserRepositoryInterface;
use App\Repositories\Images\Abstracts\ImagesRepositoryInterface;
use App\Services\Workers\Abstracts\WorkersServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class WorkersService implements WorkersServiceInterface
{


    /** @var UserRepositoryInterface */
    private UserRepositoryInterface $userRepository;
    private ImagesRepositoryInterface $imagesRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     * @param ImagesRepositoryInterface $imagesRepository
     */
    public function __construct(UserRepositoryInterface   $userRepository,
                                ImagesRepositoryInterface $imagesRepository)
    {
        $this->userRepository = $userRepository;
        $this->imagesRepository = $imagesRepository;
    }

    /**
     * @inheritDoc
     */
    public function workers(User $user): LengthAwarePaginator
    {
        if (in_array($user->role_type, [DepartmentsType::WORKER, DepartmentsType::ADMIN])) {
            return $this->userRepository->userWorker($user);
        }

        throw new AccessException();
    }

    /**
     * @inheritDoc
     */
    public function showUserWorker(int $user): ?User
    {
        return $this->userRepository->with(['workPosition', 'departmentName'])->findWhere(['id' => $user])->first();
    }

    /**
     * @inheritDoc
     */
    public function updateUser(?User $user, UpdateUserDTO $updateUserDTO): void
    {
        $this->userRepository->updateUser($user, $updateUserDTO);
    }

    /**
     * @param User $user
     * @param ImageUploadDTO $imageDTO
     * @return int
     */
    public function uploadImages(User $user, ImageUploadDTO $imageDTO): int
    {
        if (isset($imageDTO->filename)) {
            $image = $imageDTO->filename;
            $imageName = $user->id . $image->getClientOriginalName();

            $imageUser = $this->imagesRepository->create([
                'filename' => 'app/images/' . $imageName
            ]);

            $image->move(storage_path('images'), $imageName);
            
            return $imageUser->id;
        }
        return false;
    }

    /** @inheritDoc */
    public function updateImages(User $user, $id): void
    {
            $this->userRepository->update(['image_id' => $id], $user->id);
    }
}
