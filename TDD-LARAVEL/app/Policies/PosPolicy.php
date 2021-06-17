<?php

namespace App\Policies;

use App\Models\Pos;
use App\Models\User;

class PosPolicy
{
    public function update(User $user, Pos $pos) {
        if(isset($user->distribuidor)) {
            return $user->distribuidor->is($pos->distribuidor);
        }
    }
}
