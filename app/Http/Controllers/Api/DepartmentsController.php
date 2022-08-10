<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Departments\Abstracts\DepartmentsServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

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
     * @return ?Collection
     */
    public function departments(): ?Collection
    {
        $user = Auth::user();
        return $this->service->DepartmentsAndWorkers($user);
    }
}
