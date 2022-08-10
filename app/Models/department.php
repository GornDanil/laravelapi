<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperdepartment
 */
class department extends Model
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
