<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'reference_number',
        'amount',
        'ip',
        'type'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
