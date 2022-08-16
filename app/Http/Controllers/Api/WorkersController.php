<?php

namespace App\Http\Controllers\Api;

use App\Domain\DTO\ImageUploadDTO;
use App\Domain\DTO\UpdateUserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Authentication\ImageUploadRequest;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Models\User;
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
     * @return array<User>|LengthAwarePaginator|Response
     * @throws RepositoryException
     */
    public function workersList(): array|LengthAwarePaginator|Response
    {
        return $this->service->workers(Auth::user());
    }

    /**
     * @return User
     */
    public function user(): object
    {
        /** @var User|null $user */
        $user = Auth::user();
        return $this->service->showUserWorker($user->id);
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
     * @param UpdateUserRequest $request
     * @return Response
     */
    public function updateUser(UpdateUserRequest $request): Response
    {
        $updateUserDTO = new UpdateUserDTO($request->validated());

        $this->service->updateUser(Auth::user(), $updateUserDTO);

        return response(["message" => "Ваш профиль обновлен"]);
    }

    /**
     * @param ImageUploadRequest $request
     * @return \Illuminate\Http\Response
     */
    public function updateImages(ImageUploadRequest $request): \Illuminate\Http\Response
    {
        $imageUploadDTO = new ImageUploadDTO($request->validated());

        $this->service->updateImages(Auth::user(), $imageUploadDTO);

        return response(['message' => 'Фотография успешно добавлена']);
    }
}
