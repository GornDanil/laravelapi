<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Image
 * @mixin IdeHelperImage
 */
class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];
}
