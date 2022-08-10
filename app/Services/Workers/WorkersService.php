<?php

namespace App\Services\Workers;

use App\Repositories\Authentication\Abstracts\UserRepositoryInterface;
use App\Services\Workers\Abstracts\WorkersServiceInterface;
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
    public function workers(object $user): LengthAwarePaginator|Response
    {
        if ($user->role_type == "worker") {
            return $this->userRepository->userWorker($user);
        }

        if ($user->role_type == "admin") {
            return $this->userRepository->all()->paginate(10);
        }

        return response("У вас нет доступа к этой странице");
    }

    /**
     * @inheritDoc
     */
    public function showUserWorker($user): ?object
    {
        return $this->userRepository->findWhere(['id' => $user])->first();
    }

    /**
     * @inheritDoc
     */
    public function updateUser($user, $updateUserDTO): Response
    {
        $user->update([['about' => $updateUserDTO->about],
            ['city' => $updateUserDTO->city],
            ['birthday' => $updateUserDTO->birthday],
            ['phone' => $updateUserDTO->phone]
        ]);

        return response("Профиль обновлен");
    }
}
