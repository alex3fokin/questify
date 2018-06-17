<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    protected $fillable = [
        'title', 'short_description', 'description', 'photo', 'answer', 'rating', 'points',
        'execution_time', 'published', 'moderated', 'editable', 'author_id', 'moderation_info'
    ];

    public function getRouteKeyName() {
        return 'title';
    }

    public function author() {
        return $this->belongsTo('App\Models\User');
    }

    public function usersQuest () {
        return $this->hasMany('App\Models\UsersQuest');
    }

    protected $appends = [
        'avatar_full_url',
        'author_name',
    ];

    public function getAvatarFullUrlAttribute() {
        return env('PUBLIC_QUEST_FOLDER') . '/' . $this->attributes['photo'];
    }

    public function getAuthorNameAttribute() {
        return $this->load('author')->author->name;
    }
}
