<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserClub extends Model
{
    //
    protected $table = 'user_clubs';

    protected $fillable = ['club_id', 'is_member', 'date_joined', 'main_club'];
}
