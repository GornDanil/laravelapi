<?php

namespace App\Repositories\Images;

use App\Models\Images;
use App\Repositories\Images\Abstracts\ImagesRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ImagesRepository.
 *
 * @package namespace App\Repositories\Images;
 */
class ImagesRepository extends BaseRepository implements ImagesRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Images::class;
    }
}
