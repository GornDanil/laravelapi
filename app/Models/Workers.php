<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Workers
 * @mixin IdeHelperWorkers
 */
class Workers extends Model
{
    use HasFactory;


    protected $hidden = [
        'departments_id',
        'created_at',
        'updated_at'
    ];
    /**
     * @return HasMany
     */
    public function workerAtDepartment(): HasMany
    {
        return $this->hasMany(User::class, 'workers_id');
    }
}
