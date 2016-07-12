<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
  protected $fillable = [
      'name', 'telephone', 'fax', 'vat', 'street_number', 'street_name', 'city', 'postal_code', 'country'
  ];

  public function user()
  {
    return $this->hasMany(User::class);
  }
}
