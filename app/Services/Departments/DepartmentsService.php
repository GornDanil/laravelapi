<?php

namespace App\Services\Departments;

use App\Models\Department;
use App\Repositories\Departments\Abstracts\DepartmentRepositoryInterface;
use App\Services\Departments\Abstracts\DepartmentsServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class DepartmentsService implements DepartmentsServiceInterface
{
    /** @var DepartmentRepositoryInterface */
    private DepartmentRepositoryInterface $repository;

    /** @param DepartmentRepositoryInterface $repository */
    public function __construct(DepartmentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /** @inheritDoc */
    public function departments(): Collection
    {
        return $this->repository->with('workers.workerAtDepartment')->all();
    }

    /** @inheritDoc */
    public function department(int $departmentId): Department
    {
        return $this->repository->with('workers.workerAtDepartment')->find($departmentId);
    }


}
