<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username' , 'codeforces' , 'codechef' , 'spoj' , 'uva' , 'uvaid'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token', 'password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    */

    public function topic()
    {
        return $this->belongsToMany('App\Models\Topic')->withPivot('problem_id');
    }

    public function problem()
    {
        return $this->belongsToMany('App\Models\Problem');
    }

    public function generaltopic()
    {
        return $this->belongsToMany('App\Models\Generaltopic')->withPivot('problem_id');
    }
}
