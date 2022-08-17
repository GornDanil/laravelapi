<?php

namespace App\Services\Departments\Abstracts;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface DepartmentsServiceInterface
{
    /**
     * @return Collection
     */
    public function departments(): Collection;

    /**
     * @param int $departmentId
     * @return Department
     */
    public function department(int $departmentId): Department;


}
