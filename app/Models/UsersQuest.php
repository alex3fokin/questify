<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersQuest extends Model
{
    protected $fillable = [
        'user_id', 'quest_id', 'status', 'time_start', 'time_end'
    ];

    protected $appends = [
        'author_name'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function quest() {
        return $this->belongsTo('App\Models\Quest');
    }
}
