<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Score extends Model
{
    //
    protected $table = 'scores';

    protected $fillable = ['user_id', 'club_id', 'meeting_id', 'point_id', 'point_value', 'is_speech',
    'speech_title', 'evaluator', 'notes', 'which_half'];

    public function point() {
        return $this->belongsTo('App\Models\Point');
    }

    public function meeting() {
        return $this->belongsTo('App\Models\Meeting');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function displayScore() {
        return $this->point->category->name . ' : ' . $this->point_value . ' points';
    }

}
