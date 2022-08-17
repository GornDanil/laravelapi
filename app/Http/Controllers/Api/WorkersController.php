<?php

namespace App\Http\Controllers\Api;

use App\Domain\DTO\ImageUploadDTO;
use App\Domain\DTO\UpdateUserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Authentication\ImageUploadRequest;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Models\User;
use App\Services\Workers\Abstracts\WorkersServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
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
     * @return LengthAwarePaginator
     */
    public function workersList(): LengthAwarePaginator
    {
        /** @var ?User $user */
        $user = Auth::user();
        return $this->service->workers($user);
    }

    /**
     * @return User
     */
    public function user(): User
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
     * @return RedirectResponse
     */
    public function uploadImages(ImageUploadRequest $request): RedirectResponse
    {
        $imageUploadDTO = new ImageUploadDTO($request->validated());
        $image = $this->service->uploadImages(Auth::user(), $imageUploadDTO);

        return redirect()->route('updateImage', ['id' => $image]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function updateImages(int $id): Response
    {
        $user = Auth::user();

        $this->service->updateImages($user, $id);

        return response(['message' => 'Аватарка обновлена']);
    }
}
