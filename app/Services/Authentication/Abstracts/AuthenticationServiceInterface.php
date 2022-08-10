<?php

namespace App\Services\Authentication\Abstracts;

use App\Domain\DTO\LoginDTO;
use App\Domain\DTO\PasswordResetConfirmDTO;
use App\Domain\DTO\RegistrationDTO;
use App\Models\User;
use http\Env\Response;

interface AuthenticationServiceInterface
{
    /**
     * @param RegistrationDTO $data
     * @return mixed
     */
    public function registration(RegistrationDTO $data);

    /**
     * @param PasswordResetConfirmDTO $data
     * @return mixed
     */

}
