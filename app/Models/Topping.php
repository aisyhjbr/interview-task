<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['id', 'type'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_topping', 'topping_id', 'product_id');
    }
}
