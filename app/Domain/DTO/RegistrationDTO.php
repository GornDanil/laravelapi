<?php

namespace App\Domain\DTO;

/**
 * Class RegistrDTO
 *
 * @package App\Domain\DTO
 */
class RegistrationDTO extends DTO
{
    /** @var string  */
    public string $login;

    /** @var string  */
    public string $about;

    /** @var string  */
    public string $birthday;

    /** @var string  */
    public string $city;

    /** @var string  */
    public string $phone;

    /** @var string  */
    public string $name;

    /** @var string  */
    public string $email;

    /** @var string  */
    public string $filename;
    /** @var string  */
    public string $password;
}
