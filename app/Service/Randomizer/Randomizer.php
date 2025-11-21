<?php
declare(strict_types=1);

namespace App\Service\Randomizer;

use App\Interfaces\Services\RandomizerInterface;
use Random\Randomizer as DefaultRandomizer;

readonly class Randomizer implements RandomizerInterface
{
    public function __construct(
        private DefaultRandomizer $randomizer,
    ) {
    }

    public function getInt(int $min, int $max): int
    {
        return $this->randomizer->getInt($min, $max);
    }
}
