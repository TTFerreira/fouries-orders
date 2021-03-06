<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable = ['user_id', 'orderupdate_id'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function orderupdate()
  {
    return $this->belongsTo(Orderupdate::class);
  }

  public function orderitem()
  {
    return $this->belongsTo(OrderItem::class);
  }
}
