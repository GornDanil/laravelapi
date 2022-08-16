<?php

namespace App\Services\Authentication;

use App\Domain\DTO\LoginDTO;
use App\Domain\DTO\PasswordResetConfirmDTO;
use App\Domain\DTO\RegistrationDTO;
use App\Exceptions\AuthontificationException;
use App\Exceptions\EmailNotUniqueException;
use App\Repositories\Authentication\Abstracts\UserRepositoryInterface;
use App\Services\Authentication\Abstracts\AuthenticationServiceInterface;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthenticationService implements AuthenticationServiceInterface
{
    /** @var UserRepositoryInterface */
    private UserRepositoryInterface $repository;


    /**
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function registration(RegistrationDTO $data): array
    {
        if (count($this->repository->findWhere(['email' => $data->email])) == 0) {
            $data->password = Hash::make($data->password);

            $user = $this->repository->create($data->toArray());
            return [
                $user->createToken('token')->plainTextToken,
                $this->repository->userCard($user->id)
            ];
        }
        throw new EmailNotUniqueException();
    }

    /**
     * @inheritDoc
     */
    public function login(LoginDTO $data): array
    {
        $dataUser = $this->repository->findWhere(['email' => $data->email]);

        if (count($dataUser) == 0) {
            throw new AuthontificationException();
        }
        $user = $dataUser->first();

        if (!Hash::check($data->password, $user->password)) {
            throw new AuthontificationException();
        }
        return [
            $user->createToken('token')->plainTextToken,
            $this->repository->userCard($user->id)
        ];
    }

    public function resetPassword(PasswordResetConfirmDTO $passwordResetDTO): string {
        $passwordResetDTO = $passwordResetDTO->toArray();

        return Password::reset(
            $passwordResetDTO,
            function ($user) use ($passwordResetDTO) {
                $user->forceFill([
                    'password' => Hash::make($passwordResetDTO['password']),
                    'remember_token' => Str::random(64),
                ])->save();

                $user->tokens()->delete();

                event(new PasswordReset($user));
            }
        );
    }
}
