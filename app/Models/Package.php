<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'category', 'price', 'promo_price', 'description', 'is_best_deal', 'badge_text'])]
class Package extends Model
{
    //
}
