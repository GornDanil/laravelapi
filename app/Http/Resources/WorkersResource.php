<?php

namespace App\Http\Resources;

use App\Domain\Enums\Departments\DepartmentsType;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * @mixin Worker
 */
class WorkersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        /** @var User|null $user */
        $user = $request->user();
        $data = [
            'id' => $this->id,
            'name' => $this->name
        ];

        if($user && in_array($user->role_type, [DepartmentsType::ADMIN, DepartmentsType::WORKER]) && $this->workerAtDepartment) {
            $data['worker_at_department'] = UserWorkerResource::collection($this->workerAtDepartment);
        }

        return $data;
    }
}
