<?php
declare(strict_types=1);

namespace App\Policies;

use App\Models\Link;
use App\Models\User;

class LinkPolicy
{
    public function owner(User $user, Link $link): bool
    {
        return $user->getKey() === $link->user_id;
    }
}
