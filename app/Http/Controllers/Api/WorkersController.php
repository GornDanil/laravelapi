<?php

namespace App\Http\Controllers\Api;
use App\Domain\DTO\UpdateUserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Services\Workers\Abstracts\WorkersServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Exceptions\RepositoryException;
use Symfony\Component\HttpFoundation\Response;

class WorkersController extends Controller
{
    /** @var WorkersServiceInterface $service */
    private WorkersServiceInterface $service;

    /** @param WorkersServiceInterface $service */
    public function __construct(WorkersServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @return array|LengthAwarePaginator|Response
     * @throws RepositoryException
     */
    public function workersList(): array|LengthAwarePaginator|Response
    {
        $user = Auth::user();
        return $this->service->workers($user);
    }

    /**
     * @param int $user
     * @return object|Response
     */
    public function userWorker(int $user): ?object
    {
        return $this->service->showUserWorker($user);
    }

    /**
     * @return object
     */
    public function user(): object
    {
        return $this->service->showUserWorker(Auth::user()->id);
    }

    /**
     * @param UpdateUserRequest $request
     * @return Response
     */
    public function updateUser(UpdateUserRequest $request): Response
    {
        $data = $request->validated();

        $updateUserDTO = new UpdateUserDTO($data);

        $user = Auth::user();

        return $this->service->updateUser($user, $updateUserDTO);
    }
}
