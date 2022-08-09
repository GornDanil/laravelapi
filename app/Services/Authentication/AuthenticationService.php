<?php

namespace App\Services\Authentication;

use App\Domain\DTO\LoginDTO;
use App\Domain\DTO\RegistrationDTO;
use App\Models\Image;
use App\Models\User;
use App\Repositories\Authentication\Abstracts\UserRepositoryInterface;
use App\Services\Authentication\Abstracts\AuthenticationServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationService implements AuthenticationServiceInterface
{
    /** @var UserRepositoryInterface */
    private UserRepositoryInterface $repository;

    /** @param UserRepositoryInterface $repository */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function registration(RegistrationDTO $data)
    {
        $dataUser = $this->repository->findWhere(['email' => $data->email]);

        if (count($dataUser) == 0) {
            $data->password = Hash::make($data->password);
            $user = User::create($data->toArray());
            Image::create([
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

    public function login(LoginDTO $data) {
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
