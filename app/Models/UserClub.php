<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class UserClub extends Model
{
    //
    protected $table = 'user_clubs';

    protected $fillable = [
        'club_id',
        'user_id',
        'main_club',
        'is_member',
        'is_club_admin',
        'date_joined',
        'date_left',
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    static public function createUserClubRole($user_id = '') {
        if ($user_id != '') {
            $userClub = new UserClub();
            $input = Request::all();
            $userClub->club_id = $input['club_id'];
            $userClub->user_id = $user_id;
            $userClub->is_member = 1;
            $userClub->main_club = 1;
            $userClub->date_joined = $input['date_joined'];
            $userClub->save();
        }
    }


}
