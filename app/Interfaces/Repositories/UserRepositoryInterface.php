<?php
declare(strict_types=1);

namespace App\Interfaces\Repositories;

use App\Models\User;

/**
 * @method User save(User $entity)
 */
interface UserRepositoryInterface extends RepositoryInterface
{
    public function get(string $username, string $phoneNumber): User|null;
}
