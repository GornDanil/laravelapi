<?php

namespace App\Services\Departments\Abstracts;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface DepartmentsServiceInterface
{
    /**
     * @param User $user
     * @return Collection
     */
    public function departmentsUser(User $user): Collection;

    /**
     * @param User $user
     * @return Department
     */
    public function departmentsWorker(User $user): Department;

    /**
     * @param User $user
     * @return Collection
     */
    public function departmentsAdmin(User $user): Collection;
}
