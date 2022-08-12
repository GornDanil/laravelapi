<?php

namespace App\Schema\Tables;

use App\Http\Controllers\Admin\DepartmentsController;
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
            "display_name_singular" => "Сотрудник",
            "display_name_plural" => "Сотрудники",
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
            "departments_id" => [
                "type" => FieldType::NUMBER,
                "browse" => true,
                "edit" => false
            ],
            'name' => [
                "type" => FieldType::TEXT,
                "browse" => true
            ],
            "id_hasmany_users_relationship" => [
                "type" => FieldType::RELATIONSHIP,
                "browse" => false,
                "details" => [
                    "model" => User::class,
                    "table" => "users",
                    "type" => "hasMany",
                    "column" => "id",
                    "key" => "workers_id",
                    "label" => "email"
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
