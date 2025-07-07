<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'type', 'name', 'ppu'];

   public function batters()
{
    return $this->belongsToMany(Batter::class, 'product_batter');
}

public function toppings()
{
    return $this->belongsToMany(Topping::class, 'product_topping');
}
}
