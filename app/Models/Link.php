<?php
declare(strict_types=1);

namespace App\Models;

use App\Policies\LinkPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property string $ref
 * @property Carbon|string $expires_at
 * @property Carbon|string $deactivated_at
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 * @property-read User
 */
#[UsePolicy(LinkPolicy::class)]
class Link extends Model
{
    protected $table = 'links';

    protected $casts = [
        'expires_at' => 'datetime',
        'deactivated_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
