<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
    	'name', 'dif' , 'desc' , 'youtube_video' , 'contest_link' , 'editorial_link'
    ];

    public function problem()
    {
        return $this->hasMany('App\Models\Problem');
    }

    public function user()
    {
        return $this->belongsToMany('App\User')->withPivot('problem_id');
    }
}
