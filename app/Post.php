<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'date_id', 'begin', 'finish', 'rest', 'work_time', 'note', 'coment', 'absent'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
