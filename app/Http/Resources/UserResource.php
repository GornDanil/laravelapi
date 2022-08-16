<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'login' => $this->login,
            'name' => $this->name,
            'email' => $this->email,
            'about' => $this->about,
            'role_type' => $this->role_type,
            'city' => $this->city,
            'phone' => $this->phone,
            'birthday' => $this->birthday,
            'token' => $this->createToken('token')->plainTextToken,
        ];
    }
}
