<?php
declare(strict_types=1);

namespace App\Providers;

use App\Interfaces\Services\RandomizerInterface;
use App\Service\Randomizer\Randomizer;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(RandomizerInterface::class, Randomizer::class);
    }

    public function boot(): void
    {
    }
}
