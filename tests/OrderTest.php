<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class OrderTest extends TestCase
{
  use DatabaseTransactions;

  public function testOrdersView()
  {
    $user = User::get()->first();

    $this->actingAs($user)
         ->visit('/orders')
         ->see('Orders');
  }
}
