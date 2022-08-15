<?php

namespace App\Repositories\Images\Abstracts;

use App\Models\User;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ImagesRepositoryInterface.
 *
 * @package namespace App\Repositories\Image;
 */
interface ImagesRepositoryInterface extends RepositoryInterface
{
    /**
     * @param mixed $image
     * @param User $user
     * @return mixed
     */
    public function updateImage(mixed $image, User $user);
}
