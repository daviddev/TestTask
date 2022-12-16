<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $username
 * @property string $phone_number
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection<Link> $links
 * @property-read Collection<Link> $manual_links
 * @property-read Collection<UserScore> $scores
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'phone_number',
    ];

    /**
     * @return HasMany
     */
    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }

    /**
     * @return HasMany
     */
    public function manual_links(): HasMany
    {
        return $this->links()->where('is_manual', true);
    }

    /**
     * @return HasMany
     */
    public function scores(): HasMany
    {
        return $this->hasMany(UserScore::class);
    }
}
