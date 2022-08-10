<?php

namespace App\Domain\DTO;

/**
 * Class Search
 *
 * @package App\Domain\DTO
 */
class LoginDTO extends DTO
{
    /** @var string */
    public string $email;

    /** @var string */
    public string $password;

}
