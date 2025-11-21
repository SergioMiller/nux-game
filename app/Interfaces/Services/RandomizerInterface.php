<?php
declare(strict_types=1);

namespace App\Interfaces\Services;

interface RandomizerInterface
{
    public function getInt(int $min, int $max): int;
}
