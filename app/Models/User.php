<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'avatar_full_url'
    ];

    public function getRouteKeyName() {
        return 'name';
    }

    public function quests() {
        return $this->hasMany('App\Models\Quest', 'author_id');
    }

    public function user_quests() {
        return $this->hasMany('App\Models\UserQuests');
    }

    public function getAvatarFullUrlAttribute() {
        return env('PUBLIC_AVATAR_FOLDER') . '/' . $this->attributes['photo'];
    }
}
