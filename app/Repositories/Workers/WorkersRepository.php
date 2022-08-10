<?php

namespace App\Repositories\Workers;

use App\Models\Workers;
use App\Repositories\Workers\Abstracts\WorkersRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class WorkersRepository.
 *
 * @package namespace App\Repositories\Workers;
 */
class WorkersRepository extends BaseRepository implements WorkersRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Workers::class;
    }


}
