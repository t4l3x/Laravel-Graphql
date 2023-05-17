<?php

namespace App\Domains\Authentication\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * UserActivation
 *
 * @mixin Eloquent
 */
class UserActivation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'token',
        'activated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'activated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the activation.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
