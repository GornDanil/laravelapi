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

    /** @param UserRepositoryInterface $userRepository */
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
        if ($user->role_type == DepartmentsType::WORKER) {
            return $this->userRepository->userWorker($user);
        }

        if ($user->role_type == DepartmentsType::ADMIN) {
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


    public function updateImages(User $user, ImageUploadDTO $imageDTO): void
    {
        if (isset($imageDTO->filename)) {
            $image = $imageDTO->filename;

            $imageName = $user->id . $image->getClientOriginalName();

            $imageUser = $this->imagesRepository->create([
                'filename' => 'app/images/' . $imageName
            ]);
            $image->move(public_path('images'), $imageName);
            $this->userRepository->update(['image_id' => $imageUser->id], $user->id);
        }
    }
}
