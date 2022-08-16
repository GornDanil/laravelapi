<?php

namespace App\Services\Authentication\Abstracts;

use App\Domain\DTO\LoginDTO;
use App\Domain\DTO\PasswordResetConfirmDTO;
use App\Domain\DTO\RegistrationDTO;
use App\Http\Resources\UserResource;
use Exception;

interface AuthenticationServiceInterface
{
    /**
     * @param RegistrationDTO $data
     * @return UserResource<array>
     * @throws Exception
     */
    public function registration(RegistrationDTO $data): UserResource;

    /**
     * @param LoginDTO $data
     * @return UserResource<array>
     * @throws Exception
     */
    public function login(LoginDTO $data): UserResource;

    /**
     * @param PasswordResetConfirmDTO $passwordResetDTO
     * @return string
     */
    public function resetPassword(PasswordResetConfirmDTO $passwordResetDTO): string;
}
