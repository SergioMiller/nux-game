<?php
declare(strict_types=1);

namespace App\Interfaces\Repositories;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function entityClassName(): string;

    public function save(Model $entity): Model;
}
