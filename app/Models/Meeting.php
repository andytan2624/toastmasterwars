<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Database\Eloquent\SoftDeletes;


class Meeting extends Model
{
    //
    protected $table = 'meetings';

    protected $fillable = ['club_id', 'chairman', 'serjeant_at_arms', 'secretary', 'meeting_number', 'meeting_date', 'meeting_start_time',
    'meeting_end_time', 'theme', 'business_session', 'notes'];

    public function getFullNameAttribute()
    {
        return $this->meeting_number . " (" . $this->meeting_date.") ";
    }
}
