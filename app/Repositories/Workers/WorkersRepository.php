<?php

namespace App\Repositories\Workers;

use App\Models\Worker;
use App\Repositories\Workers\Abstracts\WorkersRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class WorkersRepository.
 *
 * @package namespace App\Repositories\Worker;
 */
class WorkersRepository extends BaseRepository implements WorkersRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Worker::class;
    }


}
