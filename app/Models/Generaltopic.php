<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Generaltopic extends Model
{
    protected $fillable = [
    	'name', 'dif' , 'desc' , 
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
