<?php


namespace App\Domain\Enums\Departments;



use App\Domain\Enums\Traits\Constantable;

class DepartmentsType
{
    use Constantable;

    const USER = "user";
    const WORKER = "worker";
    const ADMIN = "admin";
}
