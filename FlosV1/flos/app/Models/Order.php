<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'orderId' ,'user_id', 'table', 'products', 'orderStatus', 'amount', 'paymentMethod','createdAt', 'closedAt'];
}
