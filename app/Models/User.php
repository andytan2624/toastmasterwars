<?php

namespace App\Models;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use SearchableTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'member_number',
        'date_joined',
        'is_super_admin',
        'date_left'
    ];

    protected $searchable = [
        'columns' => [
            'first_name' => 10,
            'last_name' => 5,
        ],
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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function __toString()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }

    /**
     * Will check if the current user is a super admin who can create meetings, scores and users
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->is_super_admin ? true : false;
    }

    public function scores()
    {
        // Get all related scores for this user
        return $this->hasMany(Score::class);
    }

    public function userClubs()
    {
        return $this->hasMany(UserClub::class);
    }

    public function clubs()
    {
        return $this->belongsToMany('App\Models\Club', 'user_clubs');
    }

}
