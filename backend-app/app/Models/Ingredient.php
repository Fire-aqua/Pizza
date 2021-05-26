<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\{Good, OrderElement};

class Ingredient extends Model
{
    use HasFactory;

    public function goods(): BelongsToMany
    {
        return $this->belongsToMany(Good::class);
    }

    public function orderElements(): BelongsToMany
    {
        return $this->belongsToMany(OrderElement::class);
    }
}
