<?php

namespace App\Services\Departments\Abstracts;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;

interface DepartmentsServiceInterface
{
    /**
     * @param object $user
     * @return Department|Response
     */
    public function DepartmentsAndWorkers(object $user): Department|Response;
}
