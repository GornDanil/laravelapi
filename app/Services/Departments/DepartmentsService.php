<?php

namespace App\Services\Departments;

use App\Models\Department;
use App\Repositories\Departments\Abstracts\DepartmentRepositoryInterface;
use App\Services\Departments\Abstracts\DepartmentsServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;

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
    public function DepartmentsAndWorkers(object $user): Department|Response
    {
        if ($user->role_type == "user") {
            return $this->repository->all();
        }

        if ($user->role_type == "worker") {
            dd($this->repository->with('workers.workerAtDepartment')->find($user->departments_id));
            // return ;

        }

        if ($user->role_type == "admin") {
            return $this->repository->with('workers.workerAtDepartment')->all();
        }
        return response("У вас нет прав для просмотра этой страницы");
    }


}
