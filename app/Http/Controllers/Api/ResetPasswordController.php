<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Authentication\PasswordResetRequest;
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
    /**
     * @param Request $request
     * @return array<string>
     * @throws ValidationException
     */
    public function forgotPassword(Request $request): array
    {


        $status = Password::sendResetLink(
            $request->only('email')
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
     * @return Application|ResponseFactory|Response
     */
    public function reset(PasswordResetRequest $request): Response|Application|ResponseFactory
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', RulesPassword::defaults()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request['password']),
                    'remember_token' => Str::random(64),
                ])->save();

                $user->tokens()->delete();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response([
                'message' => 'Password reset successfully'
            ]);
        }

        return response([
            'message' => __($status)
        ], 500);

    }
}
