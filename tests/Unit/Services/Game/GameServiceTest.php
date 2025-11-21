<?php
declare(strict_types=1);

namespace Tests\Unit\Services\Game;

use App\Interfaces\Services\RandomizerInterface;
use App\Models\Link;
use App\Service\Game\GameService;
use Database\Factories\LinkFactory;
use Illuminate\Contracts\Container\BindingResolutionException;
use LogicException;
use Mockery\MockInterface;
use Tests\TestCase;

/**
 * @see GameService
 */
class GameServiceTest extends TestCase
{
    private Link $link;

    protected function setUp(): void
    {
        parent::setUp();

        $this->link = LinkFactory::new()->create();
    }

    /**
     * @throws BindingResolutionException
     */
    public function test_play_0_number(): void
    {
        $this->mock(RandomizerInterface::class, function (MockInterface $mock) {
            $mock
                ->shouldReceive('getInt')
                ->andReturn(0);
        });

        $gameService = $this->app->make(GameService::class);

        $round = $gameService->play($this->link);

        $this->assertFalse($round->was_win);
        $this->assertSame(0, $round->number);
        $this->assertSame(0.0, $round->win_number);
    }

    /**
     * @throws BindingResolutionException
     */
    public function test_play_odd_number(): void
    {
        $this->mock(RandomizerInterface::class, function (MockInterface $mock) {
            $mock
                ->shouldReceive('getInt')
                ->andReturn(111);
        });

        $gameService = $this->app->make(GameService::class);

        $round = $gameService->play($this->link);

        $this->assertFalse($round->was_win);
        $this->assertSame(111, $round->number);
        $this->assertSame(0.0, $round->win_number);
    }

    /**
     * @throws BindingResolutionException
     */
    public function test_play_more_900(): void
    {
        $this->mock(RandomizerInterface::class, function (MockInterface $mock) {
            $mock
                ->shouldReceive('getInt')
                ->andReturn(902);
        });

        $gameService = $this->app->make(GameService::class);

        $round = $gameService->play($this->link);

        $this->assertTrue($round->was_win);
        $this->assertSame(902, $round->number);
        $this->assertSame(631.4, $round->win_number);
    }

    /**
     * @throws BindingResolutionException
     */
    public function test_play_more_600(): void
    {
        $this->mock(RandomizerInterface::class, function (MockInterface $mock) {
            $mock
                ->shouldReceive('getInt')
                ->andReturn(602);
        });

        $gameService = $this->app->make(GameService::class);

        $round = $gameService->play($this->link);

        $this->assertTrue($round->was_win);
        $this->assertSame(602, $round->number);
        $this->assertSame(301.0, $round->win_number);
    }

    /**
     * @throws BindingResolutionException
     */
    public function test_play_more_300(): void
    {
        $this->mock(RandomizerInterface::class, function (MockInterface $mock) {
            $mock
                ->shouldReceive('getInt')
                ->andReturn(302);
        });

        $gameService = $this->app->make(GameService::class);

        $round = $gameService->play($this->link);

        $this->assertTrue($round->was_win);
        $this->assertSame(302, $round->number);
        $this->assertSame(90.6, $round->win_number);
    }

    /**
     * @throws BindingResolutionException
     */
    public function test_play_identical_300(): void
    {
        $this->mock(RandomizerInterface::class, function (MockInterface $mock) {
            $mock
                ->shouldReceive('getInt')
                ->andReturn(298);
        });

        $gameService = $this->app->make(GameService::class);

        $round = $gameService->play($this->link);

        $this->assertTrue($round->was_win);
        $this->assertSame(298, $round->number);
        $this->assertSame(29.8, $round->win_number);
    }

    /**
     * @throws BindingResolutionException
     */
    public function test_play_less_300(): void
    {
        $this->mock(RandomizerInterface::class, function (MockInterface $mock) {
            $mock
                ->shouldReceive('getInt')
                ->andReturn(298);
        });

        $gameService = $this->app->make(GameService::class);

        $round = $gameService->play($this->link);

        $this->assertTrue($round->was_win);
        $this->assertSame(298, $round->number);
        $this->assertSame(29.8, $round->win_number);
    }

    /**
     * @throws BindingResolutionException
     */
    public function test_play_less_0(): void
    {
        $this->mock(RandomizerInterface::class, function (MockInterface $mock) {
            $mock
                ->shouldReceive('getInt')
                ->andReturn(-10);
        });

        $gameService = $this->app->make(GameService::class);

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Invalid random number.');

        $round = $gameService->play($this->link);
    }
}
