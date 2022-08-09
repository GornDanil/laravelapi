<?php

namespace App\Services\Departments\Abstracts;

use App\Models\User;
use Ramsey\Collection\Collection;

interface DepartmentsServiceInterface
{
    /**
     * @param User $user
     */
    public function DepartmentsAndWorkers(User $user);
}
