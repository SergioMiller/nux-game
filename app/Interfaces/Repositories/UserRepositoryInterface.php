<?php
declare(strict_types=1);

namespace App\Interfaces\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function save(User $entity): User;

    public function get(string $username, string $phoneNumber): User|null;
}
