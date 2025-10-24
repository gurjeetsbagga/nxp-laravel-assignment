<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static firstWhere(int[] $array)
 */
class Inventory extends Model
{
    public mixed $quantity;
    public mixed $product_id;
    protected $fillable = ['provider_id','product_id','quantity'];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
