<?php

namespace App\Services\Authentication\Abstracts;

use App\Domain\DTO\LoginDTO;
use App\Domain\DTO\RegistrationDTO;
use App\Models\User;

interface AuthenticationServiceInterface
{
    public function registration(RegistrationDTO $data);
}
