<?php

namespace App\Schema\Tables;

use App\Models\Department;
use App\Models\Worker;
use Atwinta\Voyager\Domain\Enum\FieldType;
use Atwinta\Voyager\Schema\BaseDataType;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\User;

/**
 * Class UserDataType
 * @package Atwinta\Voyager\Schema
 */
class UserDataType extends BaseDataType
{
    /**
     * @inheritdoc
     */
    protected function model(): string
    {
        return User::class;
    }

    public function scopeActive($query)
    {
        return $query->where('workers_id', '!=', null);
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
            "roles" => "*",
            "controller" => "TCG\Voyager\Http\Controllers\VoyagerUserController",
            "policy_name" => "TCG\Voyager\Policies\UserPolicy",
            "model_name" => $this->model(),
            "display_name_singular" => "Пользователь",
            "display_name_plural" => "Пользователи",
            "scope" => "active",
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
            "login" => [
                "display_name" => "Логин",
            ],
            "name" => [
                "display_name" => "Имя",
            ],
            "email" => [
                "display_name" => "Почта",
            ],
            "about" => [
                "display_name" => "О себе",
            ],
            "birthday" => [
                "display_name" => "Роль в системе",
            ],
            "phone" => [
                "display_name" => "Телефон",
            ],
            "city" => [
                "display_name" => "Город",
            ],
            "departments_id" => [
                "type" => FieldType::NUMBER,
                "browse" => false
            ],
            "departments_id_belongsto_worker_departments_relationship" => [
                "type" => FieldType::RELATIONSHIP,
                "display_name" => "Отдел",
                "required" => false,
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
            "workers_id" => [
                "type" => FieldType::NUMBER,
                "browse" => false
            ],
            "workers_id_belongsto_worker_relationship" => [
                "type" => FieldType::RELATIONSHIP,
                "display_name" => "Должность",
                "required" => false,
                "browse" => true,
                "edit" => true,
                "details" => [
                    "model" => Worker::class,
                    "table" => "workers",
                    "type" => "belongsTo",
                    "column" => "workers_id",
                    "key" => "id",
                    "label" => "name"
                ]
            ],
            "role_type" => [
                "display_name" => "Роль в системе",
            ],
            "password" => [
                "type" => FieldType::PASSWORD,
                "display_name" => "Пароль",
                "required" => true,
                "browse" => false,
                "read" => false,
                "edit" => true,
                "add" => true
            ],
            "remember_token" => [
                "display_name" => "Почта",
                "required" => true,
                "browse" => false,
                "read" => false,
                "edit" => false,
                "add" => false
            ],
            "avatar" => [
                "type" => FieldType::IMAGE,
                "display_name" => "Аватар",
                "required" => false,
                "browse" => false,
            ],

            "email_verified_at" => [
                "type" => FieldType::NUMBER,
                "display_name" => "Проверка почты",
                "required" => false,
                "browse" => false,
            ],
            "user_belongsto_role_relationship" => [
                "type" => FieldType::RELATIONSHIP,
                "display_name" => "Роль",
                "required" => false,
                "delete" => false,
                "browse" => false,
                "details" => [
                    "model" => "TCG\\Voyager\\Models\\Role",
                    "table" => "roles",
                    "type" => "belongsTo",
                    "column" => "role_id",
                    "key" => "id",
                    "label" => "display_name",
                    "pivot_table" => "roles",
                    "pivot" => 0
                ]
            ],

            "user_belongstomany_role_relationship" => [
                "type" => FieldType::RELATIONSHIP,
                "display_name" => "Дополнительные роли",
                "required" => false,
                "delete" => false,
                "browse" => false,
                "details" => [
                    "model" => "TCG\\Voyager\\Models\\Role",
                    "table" => "roles",
                    "type" => "belongsToMany",
                    "column" => "id",
                    "key" => "id",
                    "label" => "display_name",
                    "pivot_table" => "user_roles",
                    "pivot" => "1",
                    "taggable" => "0"
                ]
            ],
            "role_id" => [
                "display_name" => "Роль",
                "browse" => false,
            ],
            "settings" => [
                "type" => FieldType::HIDDEN,
                "display_name" => "Настройки",
                "browse" => false,
                "read" => false,
                "edit" => false,
                "add" => false,
                "delete" => false
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
