<?php

namespace App\Http\Controllers\Api;

use App\Domain\DTO\LoginDTO;
use App\Domain\DTO\RegistrationDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Authentication\LoginRequest;
use App\Http\Requests\Api\Authentication\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\Authentication\Abstracts\AuthenticationServiceInterface;
use Exception;

class AuthenticationController extends Controller
{
    /** @var AuthenticationServiceInterface */
    private AuthenticationServiceInterface $service;

    /** @param AuthenticationServiceInterface $service */
    public function __construct(AuthenticationServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @param LoginRequest $request
     * @return UserResource<array>
     * @throws Exception
     */
    public function login(LoginRequest $request): UserResource
    {
        $data = $request->validated();

        $LoginDTO = new loginDTO($data);

        $user = $this->service->login($LoginDTO);
        return new UserResource($user);
    }

    /**
     * @param RegisterRequest $request
     * @return UserResource<array>
     * @throws Exception
     */
    public function registration(RegisterRequest $request): UserResource
    {
        $user = $this->service->registration(new RegistrationDTO($request->validated()));
        return new UserResource($user);
    }
}
