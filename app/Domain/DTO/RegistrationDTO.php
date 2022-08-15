<?php

namespace App\Domain\DTO;

use phpDocumentor\Reflection\File;

/**
 * Class RegistrationDTO
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

//    public  mixed $filename;
    /** @var string  */
    public string $password;
}
