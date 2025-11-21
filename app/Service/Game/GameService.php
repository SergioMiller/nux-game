<?php
declare(strict_types=1);

namespace App\Service\Game;

use App\Interfaces\Repositories\RoundRepositoryInterface;
use App\Models\Link;
use App\Models\Round;
use League\CommonMark\Exception\LogicException;

readonly class GameService
{
    public function __construct(
        private RoundRepositoryInterface $roundRepository,
    ) {
    }

    public function play(Link $link): Round
    {
        $randomNumber = rand(0, 1000);

        $winValue = $this->getWinValue($randomNumber);

        $round = new Round();
        $round->link_id = $link->getKey();
        $round->was_win = $winValue > 0;
        $round->number = $randomNumber;
        $round->win_number = $winValue;

        return $this->roundRepository->save($round);
    }

    private function getWinValue(int $randomNumber): float
    {
        $winValue = match (true) {
            0 !== $randomNumber % 2, 0 === $randomNumber => 0,
            $randomNumber > 900 => $randomNumber * 0.7,
            $randomNumber > 600 => $randomNumber * 0.5,
            $randomNumber > 300 => $randomNumber * 0.3,
            $randomNumber <= 300 => $randomNumber * 0.1,
            default => throw new LogicException('Invalid random number.')
        };

        return round($winValue, 2);
    }
}
