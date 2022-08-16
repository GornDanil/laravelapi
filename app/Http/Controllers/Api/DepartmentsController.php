<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Services\Departments\Abstracts\DepartmentsServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DepartmentsController extends Controller
{
    /** @var DepartmentsServiceInterface $service */
    private DepartmentsServiceInterface $service;

    /** @param DepartmentsServiceInterface $service */
    public function __construct(DepartmentsServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @return Collection<int, Department>|Department|Response
     */
    public function departments(): Collection|Department|Response
    {
        return $this->service->DepartmentsAndWorkers(Auth::user());
    }
}
