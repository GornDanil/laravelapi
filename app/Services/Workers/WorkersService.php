<?php

namespace App\Services\Workers;

use App\Domain\DTO\UpdateUserDTO;
use App\Domain\Enums\Departments\DepartmentsType;
use App\Exceptions\AccessException;
use App\Models\Image;
use App\Models\User;
use App\Repositories\Authentication\Abstracts\UserRepositoryInterface;
use App\Repositories\Images\Abstracts\ImagesRepositoryInterface;
use App\Services\Workers\Abstracts\WorkersServiceInterface;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;

class WorkersService implements WorkersServiceInterface
{


    /** @var UserRepositoryInterface */
    private UserRepositoryInterface $userRepository;
    private ImagesRepositoryInterface $imagesRepository;
    /** @param UserRepositoryInterface $userRepository */
    public function __construct(UserRepositoryInterface $userRepository,
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
        $image = $updateUserDTO->filename;
        if($image) {
            $imageName = $image->getClientOriginalName();


            if($image != null) {
                $image->move(public_path('images'), $imageName);
            }

            /** @var Image $i */
            $i = $this->imagesRepository->create([
                'user_id' => $user->id,
                'filename' => 'app/images/'.$image
            ]);
        }

        $this->userRepository->updateUser($user, $updateUserDTO);

    }
}
