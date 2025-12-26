<?php

namespace App\Models;
use App\Models\Order;
use App\Models\Menu;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'menu_id', 'qty', 'price', 'subtotal'];

    public function order(){
        return $this->belongTo(Order::class);
    }

    public function menu(){
        return $this->belongTo(Menu::class);
    }
}
