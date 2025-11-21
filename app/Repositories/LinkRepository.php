<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\Repositories\LinkRepositoryInterface;
use App\Models\Link;
use Carbon\Carbon;

final class LinkRepository implements LinkRepositoryInterface
{
    public function save(Link $entity): Link
    {
        $entity->save();

        return $entity->fresh();
    }

    public function get(string $ref): Link|null
    {
        return Link::query()
            ->where('ref', $ref)
            ->where('expires_at', '>', Carbon::now()->toDateTimeString())
            ->whereNull('deactivated_at')
            ->first();
    }

    public function refExists(string $ref): bool
    {
        return Link::query()
            ->where('ref', $ref)
            ->exists();
    }
}
