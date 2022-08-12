<?php

namespace App\Services\Authentication;

use App\Domain\DTO\LoginDTO;
use App\Domain\DTO\RegistrationDTO;
use App\Repositories\Authentication\Abstracts\UserRepositoryInterface;
use App\Repositories\Images\Abstracts\ImagesRepositoryInterface;
use App\Services\Authentication\Abstracts\AuthenticationServiceInterface;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthenticationService implements AuthenticationServiceInterface
{
    /** @var UserRepositoryInterface */
    private UserRepositoryInterface $repository;

    private ImagesRepositoryInterface $imagesRepository;


    /**
     * @param UserRepositoryInterface $repository
     * @param ImagesRepositoryInterface $imagesRepository
     */
    public function __construct(UserRepositoryInterface   $repository,
                                ImagesRepositoryInterface $imagesRepository)
    {
        $this->repository = $repository;
        $this->imagesRepository = $imagesRepository;
    }

    /**
     * @inheritDoc
     */
    public function registration(RegistrationDTO $data): array
    {

        if (count($this->repository->findWhere(['email' => $data->email])) == 0) {
            $data->password = Hash::make($data->password);
            $user = $this->repository->create($data->toArray());

            $this->imagesRepository->create([
                'user_id' => $user->id,
                'filename' => $data->filename
            ]);
            return [
                $user->createToken('token')->plainTextToken,
                $this->repository->userCard($user->id)
            ];
        }
        throw new Exception("Пользователь с таким Email уже существует", 419);
    }

    /**
     * @inheritDoc
     */
    public function login(LoginDTO $data): array
    {
        $dataUser = $this->repository->findWhere(['email' => $data->email]);

        if (count($dataUser) == 0) {
            throw new Exception("Такого пользователя не существует");
        }
        $user = $dataUser->first();

        if (!Hash::check($data->password, $user->password)) {
            throw new Exception("Неправильный пароль Дружок");
        }
        return [
            $user->createToken('token')->plainTextToken,
            $this->repository->userCard($user->id)
        ];
    }


}
