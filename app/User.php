<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getUserStatusAttribute()
    {
        $isActive = [];

        if ($this->status == 1) {
            return $isActive = [
                'is_active' => 'Aktif',
                'color'     => 'green'
            ];
//            echo '<span class="chip green lighten-5"><span class="green-text">Aktif</span></span>';
        } else {
            return $isActive = [
                'is_active' => 'Pasif',
                'color'     => 'red'
            ];
        }
    }

    public function getImageAttribute($value)
    {
        return Storage::url($value);
    }

}
