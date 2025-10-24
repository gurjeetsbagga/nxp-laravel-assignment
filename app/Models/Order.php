<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $array)
 */
class Order extends Model
{
    public mixed $status;
    public mixed $id;
    public mixed $total;
    public mixed $provider_id;
    protected $fillable = ['provider_id','status','total_amount','meta'];

    protected $casts = [
        'meta' => 'array',
    ];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
