<?php

namespace App\Policies;

use App\Models\User;

class IsSuperAdmin
{
    public function checkIsSuperAdmin(User $user) {
        return $user->is_super_admin == 1;
    }
}
