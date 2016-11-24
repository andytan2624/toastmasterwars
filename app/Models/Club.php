<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class Club extends Model
{
    //
    protected $table = 'clubs';

    public function userClubs() {
        return $this->hasMany(UserClub::class);
    }
}
