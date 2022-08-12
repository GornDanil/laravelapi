<?php

namespace App\Services\Authentication\Abstracts;

use App\Domain\DTO\LoginDTO;
use App\Domain\DTO\RegistrationDTO;
use Exception;

interface AuthenticationServiceInterface
{
    /**
     * @param RegistrationDTO $data
     * @return array<int,mixed>
     * @throws Exception
     */
    public function registration(RegistrationDTO $data): array;

    /**
     * @param LoginDTO $data
     * @return array<int, mixed>
     * @throws Exception
     */
    public function login(LoginDTO $data): array;
}
