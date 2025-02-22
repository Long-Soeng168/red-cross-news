<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $table = "shops";
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class, 'shop_id', 'id');
    }

    public function categories() {
        return $this->hasMany(Category::class, 'shop_id', 'id');
    }

    public function types() {
        return $this->hasMany(Type::class, 'shop_id', 'id');
    }

    public function items() {
        return $this->hasMany(Item::class, 'shop_id', 'id');
    }

}
