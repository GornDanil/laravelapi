<?php

namespace App\Services\Departments;

use App\Models\User;
use App\Repositories\Departments\Abstracts\DepartmentRepositoryInterface;
use App\Services\Departments\Abstracts\DepartmentsServiceInterface;
use Ramsey\Collection\Collection;

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
    public function DepartmentsAndWorkers(User $user)
    {
        if ($user->role_type == "user") {
            return $this->repository->all();
        }

        if ($user->role_type == "worker") {
            return $this->repository->with('workers.workerAtDepartment')->find($user->departments_id);
        }

        if ($user->role_type == "admin") {
            return $this->repository->with('workers.workerAtDepartment')->all();
        }

    }


}
