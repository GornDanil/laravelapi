<?php

namespace App\Services\Departments\Abstracts;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface DepartmentsServiceInterface
{
    /**
     * @param User $user
     * @return Collection<int,Department>|Department
     */
    public function DepartmentsAndWorkers(User $user): Collection|Department;
}
