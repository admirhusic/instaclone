<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $guarded = [];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function likers()
    {
        return $this->belongsToMany('App\User', 'likes');
    }
}
