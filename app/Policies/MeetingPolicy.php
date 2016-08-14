<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use App\Models\Meeting;

class MeetingPolicy
{
    public function show(User $user, Meeting $meeting) {
        return $meeting->chairman == $user->id;
    }
}
