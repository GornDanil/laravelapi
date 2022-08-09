<?php

namespace App\Repositories\Departments;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Repositories\Departments\Abstracts\DepartmentRepositoryInterface;
use App\Models\department;

/**
 * Class DepartmentRepository.
 *
 * @package namespace App\Repositories\Departments;
 */
class DepartmentRepository extends BaseRepository implements DepartmentRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Department::class;
    }

}
