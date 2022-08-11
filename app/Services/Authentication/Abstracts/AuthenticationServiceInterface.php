<?php

namespace App\Services\Authentication\Abstracts;

use App\Domain\DTO\LoginDTO;
use App\Domain\DTO\RegistrationDTO;
use App\Models\User;
use Eloquent;
use Exception;
use Symfony\Component\HttpFoundation\Response;

/** @mixin Eloquent */
interface AuthenticationServiceInterface
{
    /**
     * @param RegistrationDTO $data
     * @return Response|array<string,User>|Exception
     */
    public function registration(RegistrationDTO $data): array|Response|Exception;

    /**
     * @param LoginDTO $data
     * @return User
     */
    public function login(LoginDTO $data): User;
}
