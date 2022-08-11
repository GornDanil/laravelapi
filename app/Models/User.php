<?php

namespace App\Models;

use App\Notifications\PasswordResetNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\User
 * @mixin IdeHelperUser
 * @method create(array $toArray)
 */
class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'login',
        'about',
        'email',
        'birthday',
        'city',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'created_at',
        'updated_at',
        'departments_id',
        'workers_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $with = [
        'image',
    ];


    /** @return HasOne */
    public function image(): HasOne
    {
        return $this->hasOne(Image::class);
    }

    /** @return BelongsTo */
    public function departmentName(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'departments_id');
    }

    /** @return BelongsTo */
    public function workPosition(): BelongsTo
    {
        return $this->belongsTo(Workers::class, 'workers_id');
    }

    /**
     * @param $token
     * @return void
     */
    public function sendPasswordResetNotification($token): void
    {

        $url = $token;

        $this->notify(new PasswordResetNotification($url));
    }
}
