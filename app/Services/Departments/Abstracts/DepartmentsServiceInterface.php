<?php

namespace App\Services\Departments\Abstracts;

use App\Models\Department;
use Illuminate\Database\Eloquent\Collection;

interface DepartmentsServiceInterface
{
    /**
     * @param object $user
     * @return Collection<Department>|Department
     */
    public function DepartmentsAndWorkers(object $user): Collection|Department;
}
