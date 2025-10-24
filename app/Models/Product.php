<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = ['sku','name','units_per_box','price'];

    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class);
    }
}
