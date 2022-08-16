<?php

namespace App\Domain\DTO;

/**
 * Class Search
 *
 * @package App\Domain\DTO
 */
class PasswordResetConfirmDTO extends DTO
{
    /** @var string */
    public string $email;

    /** @var string */
    public string $token;

    /** @var string */
    public string $password;


}
