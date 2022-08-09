<?php

namespace App\Http\Controllers\Api;

use App\Domain\DTO\LoginDTO;
use App\Domain\DTO\RegistrationDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Authentication\LoginRequest;
use App\Http\Requests\Api\Authentication\RegisterRequest;
use App\Services\Authentication\Abstracts\AuthenticationServiceInterface;
use Atwinta\DTO\Exceptions\DtoException;
use Mockery\Exception;

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
     *
     */
    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $LoginDTO = new loginDTO($data);
        return $this->service->login($LoginDTO);

    }

    /**
     * @param RegisterRequest $request
     * @return string
     * @throws DtoException
     */
    public function registration(RegisterRequest $request)
    {
        $data = $request->validated();
        $registryDTO = new RegistrationDTO($data);
        return $this->service->registration($registryDTO);
    }

}
