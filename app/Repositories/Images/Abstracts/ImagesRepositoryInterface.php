<?php

namespace App\Repositories\Images\Abstracts;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
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
     * @param Authenticatable $user
     * @return void
     */
    public function updateImage(mixed $image, Authenticatable $user): void;
}
