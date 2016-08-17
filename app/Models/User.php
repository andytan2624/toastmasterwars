<?php

namespace App\Models;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles;

    use SearchableTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'member_number', 'date_joined'
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

    public function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
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


}
