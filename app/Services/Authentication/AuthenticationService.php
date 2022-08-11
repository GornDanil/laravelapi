<?php

namespace App\Services\Authentication;

use App\Domain\DTO\LoginDTO;
use App\Domain\DTO\RegistrationDTO;
use App\Models\Image;
use App\Models\User;
use App\Repositories\Authentication\Abstracts\UserRepositoryInterface;
use App\Services\Authentication\Abstracts\AuthenticationServiceInterface;
use Eloquent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Octane\Exceptions\DdException;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationService implements AuthenticationServiceInterface
{
    /** @var UserRepositoryInterface */
    private UserRepositoryInterface $repository;

    /** @param UserRepositoryInterface $repository */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     * @mixin Eloquent
     */
    public function registration(RegistrationDTO $data): array|Response
    {
        $dataUser = $this->repository->findWhere(['email' => $data->email]);
        if (count($dataUser) == 0) {
            $data->password = Hash::make($data->password);

            $user = new User;

           $user->create($data->toArray());
           $image = new Image;

           $image->create([
                'user_id' => $user->id,
                'filename' => $data->filename
            ]);

            return [
                $user->createToken('token')->plainTextToken,
                $user
            ];
        } else {
            return response("Пользователь с таким email уже существует");
        }
    }

    /**
     * @inheritDoc
     * @throws DdException
     */
    public function login(LoginDTO $data): array
    {
        $dataUser = $this->repository->findWhere(['email' => $data->email]);

        if (count($dataUser) == 0) {
            dd($dataUser);
        }
        $user = $dataUser->first();

        if (!Hash::check($data->password, $user->password)) {
            dd('Неправильный пароль Дружок');
        }
        Auth::login($user);
        return [
            $user->createToken('token')->plainTextToken,
            $user
        ];
    }


}
