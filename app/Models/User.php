<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $username
 * @property string $phone_number
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 */
final class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
}
