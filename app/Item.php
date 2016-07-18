<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
  protected $fillable = ['item_code', 'description'];

  public function orderitem()
  {
    return $this->belongsTo(OrderItem::class);
  }

  public function itemCategory()
  {
    return $this->belongsTo(ItemCategory::class);
  }
}
