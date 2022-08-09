<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Authentication\LoginRequest;
use App\Services\Departments\Abstracts\DepartmentsServiceInterface;
use Illuminate\Http\Request;
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

    public function departments()
    {
        $user = Auth::user();
        $data = $this->service->DepartmentsAndWorkers($user);
        return $data;
    }
}
