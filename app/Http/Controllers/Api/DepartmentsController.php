<?php

namespace App\Http\Controllers\Api;

use App\Domain\Enums\Departments\DepartmentsType;
use App\Exceptions\AccessException;
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
     * @return Collection<int, Department>|Department
     */
    public function departments(): Collection|Department
    {
        $user  = Auth::user();

        if ($user->role_type == DepartmentsType::USER) {
            return $this->service->departmentsUser($user);
        }

        if ($user->role_type == DepartmentsType::WORKER) {
            return $this->service->departmentsWorker($user);
        }

        if ($user->role_type == DepartmentsType::ADMIN) {
            return $this->service->departmentsAdmin($user);
        }

        throw new AccessException();
    }
}
