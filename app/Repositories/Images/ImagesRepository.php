<?php

namespace App\Repositories\Images;

use App\Models\Image;
use App\Repositories\Images\Abstracts\ImagesRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ImagesRepository.
 *
 * @package namespace App\Repositories\Image;
 */
class ImagesRepository extends BaseRepository implements ImagesRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Image::class;
    }

}
