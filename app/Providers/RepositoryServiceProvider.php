<?php
declare(strict_types=1);

namespace App\Providers;

use App\Interfaces\Repositories\LinkRepositoryInterface;
use App\Interfaces\Repositories\RoundRepositoryInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Repositories\LinkRepository;
use App\Repositories\RoundRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

final class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(LinkRepositoryInterface::class, LinkRepository::class);
        $this->app->bind(RoundRepositoryInterface::class, RoundRepository::class);
    }

    public function boot(): void
    {
    }
}
