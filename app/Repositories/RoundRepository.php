<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\Repositories\RoundRepositoryInterface;
use App\Models\Link;
use App\Models\Round;
use Illuminate\Support\Collection;

final class RoundRepository implements RoundRepositoryInterface
{
    public function save(Round $entity): Round
    {
        $entity->save();

        return $entity->fresh();
    }

    public function getLastByLink(Link $link): Collection
    {
        return Round::query()
            ->where('link_id', $link->id)
            ->limit(3)
            ->latest()
            ->get();
    }
}
