<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Department
 * @mixin IdeHelperdepartment
 */
class Department extends Model
{
    use HasFactory;


    protected $with = [
        'workers'
    ];

    public function workers(): HasMany
    {
        return $this->hasMany(Workers::class, 'departments_id');
    }
}