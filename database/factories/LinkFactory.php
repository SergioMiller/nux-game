<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Link>
 */
final class LinkFactory extends Factory
{
    protected $model = Link::class;

    public function definition(): array
    {
        return [
            'user_id' => UserFactory::new(),
            'ref' => Str::random(120),
            'expires_at' => Carbon::now()->addSeconds(config('game.link_lifetime'))->toDateTimeString(),
        ];
    }
}
