<?php
declare(strict_types=1);

namespace App\Interfaces\Repositories;

use App\Models\Link;

interface LinkRepositoryInterface
{
    public function save(Link $entity): Link;

    public function get(string $ref): Link|null;

    public function refExists(string $ref): bool;
}
