<?php


namespace App\Domain\Enums\Pastes;



use App\Domain\Enums\Traits\Constantable;

class DepartmentsType
{
    use Constantable;

    const PUBLIC = "public";
    const UNLISTED = "unlisted";
    const PRIVATE = "private";
}
