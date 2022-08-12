<?php

namespace App\Http\Controllers\Api;

use App\Domain\DTO\LoginDTO;
use App\Domain\DTO\RegistrationDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Authentication\LoginRequest;
use App\Http\Requests\Api\Authentication\RegisterRequest;
use App\Models\User;
use App\Services\Authentication\Abstracts\AuthenticationServiceInterface;
use Exception;
use Symfony\Component\HttpFoundation\Response;

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
     * @return array<int, mixed>
     * @throws Exception
     */
    public function login(LoginRequest $request): array
    {
        $data = $request->validated();

        $LoginDTO = new loginDTO($data);

        return $this->service->login($LoginDTO);

    }

    /**
     * @param RegisterRequest $request
     * @return array<int, mixed>
     * @throws Exception
     */
    public function registration(RegisterRequest $request): array
    {
        return $this->service->registration(new RegistrationDTO($request->validated()));
    }


}
