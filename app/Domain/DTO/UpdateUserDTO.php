<?php

namespace App\Domain\DTO;

/**
 * Class RegistrDTO
 *
 * @package App\Domain\DTO
 */
class UpdateUserDTO extends DTO
{
    /** @var string  */
    public string $about;

    /** @var string  */
    public string $birthday;

    /** @var string  */
    public string $city;

    /** @var string  */
    public string $phone;

}
