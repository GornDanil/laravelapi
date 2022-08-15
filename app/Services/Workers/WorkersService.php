<?php

namespace App\Services\Workers;

use App\Domain\Enums\Departments\DepartmentsType;
use App\Repositories\Authentication\Abstracts\UserRepositoryInterface;
use App\Services\Workers\Abstracts\WorkersServiceInterface;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;

class WorkersService implements WorkersServiceInterface
{


    /** @var UserRepositoryInterface */
    private UserRepositoryInterface $userRepository;

    /** @param UserRepositoryInterface $userRepository */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * @inheritDoc
     */
    public function workers(object $user): array|LengthAwarePaginator|Response
    {
        if ($user->role_type == DepartmentsType::WORKER) {
            return $this->userRepository->userWorker($user);
        }

        if ($user->role_type == DepartmentsType::ADMIN) {
            return $this->userRepository->userWorker($user);
        }

        throw new Exception("У вас нет доступа к этой странице", 408);
    }

    /**
     * @inheritDoc
     */
    public function showUserWorker(int $user): ?object
    {
        return $this->userRepository->with(['workPosition', 'departmentName'])->findWhere(['id' => $user])->first();
    }

    /**
     * @inheritDoc
     */
    public function updateUser($user, $updateUserDTO): Response
    {
        $image = $updateUserDTO->toArray()['filename'];
        if($image != null) {
            $image->move(public_path('images'), $image->extension());
        }
        $this->userRepository->updateUser($user, $updateUserDTO);

        return response("Ваш профиль обновлен");
    }
}
