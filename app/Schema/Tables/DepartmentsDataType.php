<?php

namespace App\Schema\Tables;

use App\Http\Controllers\Admin\DepartmentsController;
use App\Models\Department;
use Atwinta\Voyager\Domain\Enum\FieldType;
use Atwinta\Voyager\Schema\BaseDataType;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DepartmentsDataType
 * @package Atwinta\Voyager\Schema
 */
class DepartmentsDataType extends BaseDataType
{
    /**
     * @inheritdoc
     */
    protected function model(): string
    {
        return Department::class;
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
            "controller" => DepartmentsController::class,
            "model_name" => $this->model(),
            "display_name_singular" => "Отдел",
            "display_name_plural" => "Отделы",
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
            "department" => [
                "type" => FieldType::TEXT,
                "display_name" => "Отделы",
                "browse" => true,
                "edit" => true
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
