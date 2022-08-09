<?php

namespace App\Services\Workers;

use App\Models\User;
use App\Repositories\Authentication\Abstracts\UserRepositoryInterface;
use App\Repositories\Workers\Abstracts\WorkersRepositoryInterface;
use App\Services\Workers\Abstracts\WorkersServiceInterface;
use http\Env\Response;

class WorkersService implements WorkersServiceInterface
{
    /** @var WorkersRepositoryInterface */
    private WorkersRepositoryInterface $repository;


    private UserRepositoryInterface $userRepository;

    /**
     * @param WorkersRepositoryInterface $repository
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        WorkersRepositoryInterface $repository,
        UserRepositoryInterface    $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }


    public function workers(object $user)
    {
        if ($user->role_type == "user") {
            return response("У вас нет доступа к этой странице");
        }

        if ($user->role_type == "worker") {
            return $this->userRepository->userWorker($user);
        }

        if ($user->role_type == "admin") {
            return $this->userRepository->all();
        }
    }
}
