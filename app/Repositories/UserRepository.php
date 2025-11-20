<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\Repositories\UserRepositoryInterface;

final class UserRepository implements UserRepositoryInterface
{
    public function save(User $entity): User
    {
        $entity->save();

        return $entity->fresh();
    }

    public function get(string $username, string $phoneNumber): User|null
    {
        return User::query()
            ->where(['username' => $username])
            ->where(['phone_number' => $phoneNumber])
            ->first();
    }
}
