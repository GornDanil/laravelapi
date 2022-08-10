<?php

namespace App\Repositories\Departments;

use App\Models\Department;
use App\Repositories\Departments\Abstracts\DepartmentRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

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
    public function model(): string
    {
        return Department::class;
    }

}
