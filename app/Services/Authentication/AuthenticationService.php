<?php

namespace App\Services\Authentication;

use App\Domain\DTO\LoginDTO;
use App\Domain\DTO\RegistrationDTO;
use App\Repositories\Authentication\Abstracts\UserRepositoryInterface;
use App\Repositories\Images\Abstracts\ImagesRepositoryInterface;
use App\Services\Authentication\Abstracts\AuthenticationServiceInterface;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Client\Request;

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

//            $images = $data->toArray()['filename'];
//
//            $images->move(public_path('images'), $images->extension());
//
//            $this->imagesRepository->create([
//                'user_id' => $user->id,
//                'filename' => $images->extension()
//            ]);
            return [
                $user->createToken('token')->plainTextToken,
                $this->repository->userCard($user->id)
            ];
        }
        throw new Exception("Пользователь с таким Email уже существует", 409);
    }

    /**
     * @inheritDoc
     */
    public function login(LoginDTO $data): array
    {
        $dataUser = $this->repository->findWhere(['email' => $data->email]);

        if (count($dataUser) == 0) {
            throw new Exception("Ошибка в заполнении данных", 408);
        }
        $user = $dataUser->first();

        if (!Hash::check($data->password, $user->password)) {
            throw new Exception("Ошибка в заполнении данных", 408);
        }
        return [
            $user->createToken('token')->plainTextToken,
            $this->repository->userCard($user->id)
        ];
    }


}
