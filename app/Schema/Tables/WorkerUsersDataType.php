<?php

namespace App\Schema\Tables;

use App\Http\Controllers\Admin\DepartmentsController;
use App\Models\Department;
use App\Models\User;
use App\Models\Worker;
use Atwinta\Voyager\Domain\Enum\FieldType;
use Atwinta\Voyager\Schema\BaseDataType;
use Illuminate\Database\Eloquent\Model;

/**
 * Class WorkerUsersDataType
 * @package Atwinta\Voyager\Schema
 */
class WorkerUsersDataType extends BaseDataType
{
    protected function model(): string
    {
        return Worker::class;
    }
    /**
     * @inheritdoc
     */
    public function getDataTypeArray(): array
    {
        /**
         * @property string custom_menu_title - not required value
         * @property string custom_menu_icon - not required value
         * @property string custom_menu_url - not required value
         */

        return [
            "slug" => $this->table()->getTable(),
            "roles" => [],
            "model_name" => $this->model(),
            "display_name_singular" => "Должность",
            "display_name_plural" => "Должности",
        ];
    }



    /**
     * @inheritdoc
     */
    public function getDataRowsArray(): array
    {
        return [
            $this->table()->getKeyName() => [
                "type" => FieldType::NUMBER,
                "display_name" => "#"
            ],
            "id" => [
                "type" => FieldType::NUMBER,
                "browse" => true,
            ],
            'name' => [
                "type" => FieldType::TEXT,
                "display_name" => "Должность",
                "browse" => true,
                "edit" => true,
            ],
            "departments_id" => [
                "type" => FieldType::NUMBER,
                "browse" => false,
                "edit" => false
            ],
            "departments_id_belongsto_departments_relationship" => [
                "type" => FieldType::RELATIONSHIP,
                "display_name" => "Отдел",
                "browse" => true,
                "edit" => true,
                "details" => [
                    "model" => Department::class,
                    "table" => "departments",
                    "type" => "belongsTo",
                    "column" => "departments_id",
                    "key" => "id",
                    "label" => "department"
                ]
            ],
            Model::CREATED_AT => [
                "display_name" => "Дата создания",
                "browse" => false,
                "read" => true,
                "edit" => false,
                "add" => false
            ],
        ];
    }
}
