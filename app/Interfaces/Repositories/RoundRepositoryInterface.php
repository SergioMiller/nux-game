<?php
declare(strict_types=1);

namespace App\Interfaces\Repositories;

use App\Models\Link;
use App\Models\Round;
use Illuminate\Support\Collection;

interface RoundRepositoryInterface
{
    public function save(Round $entity): Round;

    public function getLastByLink(Link $link): Collection;
}
