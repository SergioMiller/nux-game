<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\Repositories\UserRepositoryInterface;

final class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    public function entityClassName(): string
    {
        return User::class;
    }

    public function get(string $username, string $phoneNumber): User|null
    {
        return $this->getEntity()
            ->newQuery()
            ->where(['username' => $username])
            ->where(['phone_number' => $phoneNumber])
            ->first();
    }
}
