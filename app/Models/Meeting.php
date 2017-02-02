<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Database\Eloquent\SoftDeletes;


class Meeting extends Model
{
    use SoftDeletes;

    protected $table = 'meetings';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = ['club_id', 'chairman', 'serjeant_at_arms', 'secretary', 'meeting_number', 'meeting_date', 'meeting_start_time',
    'meeting_end_time', 'theme', 'business_session', 'notes'];

    public function getFullNameAttribute()
    {
        return $this->meeting_number . " (" . $this->meeting_date.") ";
    }

    public function scores() {
        return $this->hasMany('App\Models\Score');
    }

    public function club() {
        return $this->belongsTo('App\Models\Club');
    }

    public function chairmanUser() {
        return $this->belongsTo('App\Models\User', 'chairman', 'id');
    }

    public function serjeantAtArmsUser() {
        return $this->belongsTo('App\Models\User', 'serjeant_at_arms', 'id');
    }

    public function secretaryUser() {
        return $this->belongsTo('App\Models\User', 'secretary', 'id');
    }

    public function getNiceMeetingDate() {
        $datetime = Carbon::parse($this->meeting_date);
        return $datetime->formatLocalized('%A %d %B %Y');
    }

    public function getAttendanceScores() {
        $attendanceScores = $this->hasMany('App\Models\Score')->where('point_id', '=', config('constants.categories.attendance_id'))->get();
        return count($attendanceScores);
    }
}
