<?php

namespace App\Http\Resources;

use App\Domain\Enums\Departments\DepartmentsType;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Department
 */
class DepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var User|null $user */
        $user = $request->user();
        $data = [
            'id' => $this->id,
            'name' => $this->department
        ];

        if ($user && in_array($user->role_type, [DepartmentsType::ADMIN, DepartmentsType::WORKER]) && $this->workers) {
            $data['worker'] = WorkersResource::collection($this->workers);
        }

        return $data;
    }
}
