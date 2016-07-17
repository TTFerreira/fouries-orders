<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderupdate extends Model
{
  protected $fillable = ['order_id', 'status_id', 'user_id'];

  public function status()
  {
    return $this->belongsTo(Status::class);
  }

  public function order()
  {
    return $this->hasOne(Order::class);
  }
}
