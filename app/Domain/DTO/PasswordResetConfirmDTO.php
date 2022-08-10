<?php

namespace App\Domain\DTO;

/**
 * Class Search
 *
 * @package App\Domain\DTO
 */
class PasswordResetConfirmDTO extends DTO
{
    public string $email;

    public string $token;
    /** @var string */
    public string $password;


}
