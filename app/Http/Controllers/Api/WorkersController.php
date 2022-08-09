<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Services\Workers\Abstracts\WorkersServiceInterface;
use Illuminate\Support\Facades\Auth;

class WorkersController extends Controller
{
    /** @var WorkersServiceInterface $service */
    private WorkersServiceInterface $service;

    /** @param WorkersServiceInterface $service */
    public function __construct(WorkersServiceInterface $service)
    {
        $this->service = $service;
    }

    public function workersList()
    {
        $user = Auth::user();
        return $this->service->workers($user);
    }
}
