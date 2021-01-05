<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image', 'position', 'rol_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* ------------------------------ Relationships ----------------------------- */

    public function rol()
    {
        return $this->hasOne(Rol::class, 'id', 'rol_id');
    }

    /* ---------------------------- AdminLTE Methods ---------------------------- */

    public function adminlte_image()
    {
        return '/storage/' . Auth::user()->image;
    }

    public function adminlte_desc()
    {
        return Auth::user()->position;
    }

    public function adminlte_profile_url()
    {
        return 'users/' . Auth::user()->id . '/edit';
    }
}
