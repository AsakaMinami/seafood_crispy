<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'price',
        'stock',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function seller()
    {
    return $this->belongsTo(User::class, 'user_id');
    }

    public function orderItems()
    {
    return $this->hasMany(OrderItem::class);
    }


}


