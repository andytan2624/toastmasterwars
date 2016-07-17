<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Database\Eloquent\SoftDeletes;


class Score extends Model
{
    //
    protected $table = 'scores';

    protected $fillable = ['user_id', 'club_id', 'meeting_id', 'point_id', 'point_value', 'is_speech',
    'speech_title', 'evaluator'];

    public function point() {
        return $this->belongsTo('App\Models\Point');
    }
}
