<?php

namespace App\Http\Controllers\Api;

use App\Domain\DTO\PasswordResetConfirmDTO;
use App\Domain\DTO\PasswordResetDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Authentication\PasswordResetRequest;
use App\Http\Requests\EmailRequest;
use App\Services\Authentication\Abstracts\AuthenticationServiceInterface;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Illuminate\Validation\ValidationException;

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
     * @return array<string>
     * @throws ValidationException
     */
    public function forgotPassword(EmailRequest $request): array
    {
        $passwordResetDTO = new PasswordResetDTO($request->validated());

        $passwordResetDTO = $passwordResetDTO->toArray();

        $status = Password::sendResetLink(
            $passwordResetDTO['email']
        );

        if ($status == Password::RESET_LINK_SENT) {
            return [
                'status' => __($status)
            ];
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }

    /**
     * @param PasswordResetRequest $request
     * @return Response|Application|ResponseFactory
     */
    public function reset(PasswordResetRequest $request): Response|Application|ResponseFactory
    {
        $passwordResetDTO = new PasswordResetConfirmDTO($request->validated());

        $status = $this->service->resetPassword($passwordResetDTO);
        if ($status == Password::PASSWORD_RESET) {
            return response([
                'message' => 'Вы успешно сменили пароль'
            ]);
        }

        return response([
            'message' => __($status)
        ], 404);
    }
}
