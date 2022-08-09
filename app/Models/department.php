<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    use HasFactory;



    protected $with = [
        'workers'
    ];

    public function workers()
    {
        return $this->hasMany(Workers::class, 'departments_id');
    }
}
