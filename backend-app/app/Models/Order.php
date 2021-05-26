<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
use App\Models\{Customer, OrderElement};

class Order extends Model
{
    use HasFactory;

    protected $appends = ['total_sum'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderElements(): HasMany
    {
        return $this->hasMany(OrderElement::class);
    }

    public function getTotalSumAttribute(): float
    {
        $sum = $this->orderElements->sum(function ($orderElement) {
            return $orderElement->count * ($orderElement->good->price +
            $orderElement->ingredients->sum(function ($ingredient) {
                return $ingredient->price;
            }));
        });
        return $sum;
    }    
}
