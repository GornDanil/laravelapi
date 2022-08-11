<?php

namespace App\Http\Controllers\Api;

use App\Domain\DTO\LoginDTO;
use App\Domain\DTO\RegistrationDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Authentication\LoginRequest;
use App\Http\Requests\Api\Authentication\RegisterRequest;
use App\Models\User;
use App\Services\Authentication\Abstracts\AuthenticationServiceInterface;
use Illuminate\Support\Facades\Auth;
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
     * @return array<string, User>
     */
    public function login(LoginRequest $request): array
    {
        $data = $request->validated();

        $LoginDTO = new loginDTO($data);

        $user = $this->service->login($LoginDTO);

        Auth::login($user);

        return [
            $user->createToken('token')->plainTextToken,
            $user
        ];
    }

    /**
     * @param RegisterRequest $request
     * @return array<string,User>|Response
     */
    public function registration(RegisterRequest $request): array|Response
    {
        $data = $request->validated();

        $registryDTO = new RegistrationDTO($data);

        return $this->service->registration($registryDTO);
    }


}
