<?php

namespace App\Services\Authentication\Abstracts;

use App\Domain\DTO\LoginDTO;
use App\Domain\DTO\RegistrationDTO;
use App\Models\User;
use Eloquent;
use Symfony\Component\HttpFoundation\Response;
/** @mixin Eloquent */
interface AuthenticationServiceInterface
{
    /**
     * @param RegistrationDTO $data
     * @return Response|array<string,User>
     */
    public function registration(RegistrationDTO $data): array|Response;

    /**
     * @param LoginDTO $data
     * @return array<string,User>

     */
    public function login(LoginDTO $data): array;
}
