<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
  protected $fillable = ['order_id', 'item_id', 'quantity'];

  public function order()
  {
    return $this->belongsTo(Order::class);
  }

  public function item()
  {
    return $this->belongsTo(Item::class);
  }
}
