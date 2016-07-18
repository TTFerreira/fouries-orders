<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
  public $timestamps = false;
   
  public function item()
  {
    return $this->hasMany(Item::class);
  }
}
