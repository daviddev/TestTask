<?php

namespace App\Models;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $key
 * @property string $url
 * @property string $status
 * @property boolean $is_manual
 * @property Carbon $expired_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read User user
 */
class Link extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'status',
        'key',
        'expired_at',
        'is_manual',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'expired_at' => 'datetime',
        'is_manual' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'url'
    ];

    /**
     * @return Attribute
     */
    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn() => route('links.show', $this->key),
        );
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param Builder $query
     * @param string $key
     * @return Builder
     */
    public function scopeActiveLink(Builder $query, string $key): Builder
    {
        return $query->whereStatus(Link::STATUS_ACTIVE)->where('key', $key)->where('expired_at', '>', now());
    }

    /**
     * @param int $limit
     * @return string
     * @throws Exception
     */
    public static function generateUniqueKey(int $limit = 10): string
    {
        do {
            $key = bin2hex(random_bytes($limit));
        } while (self::query()->where('key', $key)->exists());

        return $key;
    }
}
