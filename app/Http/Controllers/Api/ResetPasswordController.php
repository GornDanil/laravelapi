<?php

namespace App\Http\Controllers\Api;

use App\Domain\DTO\PasswordResetConfirmDTO;
use App\Domain\DTO\PasswordResetDTO;
use App\Exceptions\ResetPasswordErrorException;
use App\Exceptions\ResetPasswordException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Authentication\PasswordResetRequest;
use App\Http\Requests\Api\Authentication\EmailRequest;
use App\Http\Resources\UserResource;
use App\Services\Authentication\Abstracts\AuthenticationServiceInterface;
use Exception;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordController extends Controller
{
    /** @var AuthenticationServiceInterface */
    private AuthenticationServiceInterface $service;

    /** @param AuthenticationServiceInterface $service */
    public function __construct(AuthenticationServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @param EmailRequest $request
     * @return Response
     */
    public function forgotPassword(EmailRequest $request): Response
    {
        $passwordResetDTO = new PasswordResetDTO($request->validated());
        $passwordDTO = $passwordResetDTO->toArray();

        $status = Password::sendResetLink(
            $passwordDTO
        );

        if (!$status == Password::RESET_LINK_SENT) {
            throw new ResetPasswordException();
        }

        return response(['message' => 'Ссылка для сброса пароля отправлена на вашу почту']);
    }

    /**
     * @param PasswordResetRequest $request
     * @return UserResource
     * @throws Exception
     */
    public function reset(PasswordResetRequest $request): UserResource
    {
        $passwordResetDTO = new PasswordResetConfirmDTO($request->validated());

        $status = $this->service->resetPassword($passwordResetDTO);

        if ($status == Password::PASSWORD_RESET) {
            return new UserResource($this->service->login($passwordResetDTO));
        }

        throw new ResetPasswordErrorException();
    }
}
