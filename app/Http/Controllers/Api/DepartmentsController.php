<?php

namespace App\Http\Controllers\Api;

use App\Domain\Enums\Departments\DepartmentsType;
use App\Exceptions\AccessException;
use App\Http\Controllers\Controller;
use App\Http\Resources\DepartmentResource;
use App\Models\User;
use App\Services\Departments\Abstracts\DepartmentsServiceInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
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
     * @var User $user
     * @return AnonymousResourceCollection
     */
    public function departments(): AnonymousResourceCollection
    {
        $user = Auth::user();
        
        if($user->role_type == null) {
            throw new AccessException();
        }

        if ($user->role_type == DepartmentsType::WORKER) {
            return DepartmentResource::collection([$this->service->department($user->departments_id)]);
        } else {
            return DepartmentResource::collection($this->service->departments());
        }
    }
}
