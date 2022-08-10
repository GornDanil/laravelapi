<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperImage
 */
class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'filename'
    ];

    protected $hidden = [
        'id',
        'user_id',
        'created_at',
        'updated_at'
    ];
}
