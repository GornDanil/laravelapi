<?php

namespace App\Services\Authentication\Abstracts;

use App\Domain\DTO\LoginDTO;
use App\Domain\DTO\PasswordResetConfirmDTO;
use App\Domain\DTO\RegistrationDTO;
use App\Models\User;
use Exception;

interface AuthenticationServiceInterface
{
    /**
     * @param RegistrationDTO $data
     * @return User
     * @throws Exception
     */
    public function registration(RegistrationDTO $data): User;

    /**
     * @param LoginDTO|PasswordResetConfirmDTO $data
     * @return User
     * @throws Exception
     */
    public function login(LoginDTO|PasswordResetConfirmDTO $data): User;

    /**
     * @param PasswordResetConfirmDTO $passwordResetDTO
     * @return string
     */
    public function resetPassword(PasswordResetConfirmDTO $passwordResetDTO): string;
}
