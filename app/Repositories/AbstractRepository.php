<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\Repositories\RepositoryInterface;
use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @property Model $entity
 */
abstract class AbstractRepository implements RepositoryInterface
{
    protected function getEntity(): Model
    {
        return new ($this->entityClassName());
    }

    protected function paginator(Closure $callback, PaginationDto|null $paginationDto = null): LengthAwarePaginator
    {
        $query = $this->getEntity()->newQuery();

        $query = $callback($query);

        if (null === $paginationDto) {
            $paginationDto = new PaginationDto();
        }

        return $query->paginate(perPage: $paginationDto->getPerPage(), page: $paginationDto->getPage());
    }

    public function save(Model $entity): Model
    {
        $entity->save();

        return $entity->fresh();
    }
}
