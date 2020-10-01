<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
	protected $fillable = [
		'name' , 'platform' , 'code' , 'dif' , 'link' , 'desc' , 'topic_id' , 'status' , 'generaltopic_id'
    ];

    public function topic()
    {
        return $this->belongsTo('App\Models\Topic');
    }

    public function generaltopic()
    {
        return $this->belongsTo('App\Models\Generaltopic');
    }

    public function user()
    {
        return $this->belongsToMany('App\User');
    }
}