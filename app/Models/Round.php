<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $link_id
 * @property bool $was_win
 * @property bool $number
 * @property bool $win_number
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 */
class Round extends Model
{
    protected $table = 'rounds';
}
