<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class AdminTest extends TestCase
{
  use DatabaseTransactions;

  public function testAdminViewWithoutLoggedInUser()
  {
    $this->visit('/admin')
         ->seePageIs('/login');
  }

  public function testAdminViewWithAdminUser()
  {
    $user = User::where('name', '=', 'Terry Ferreira')->get()->first();

    $this->actingAs($user)
         ->visit('/admin')
         ->see('Administrator');
  }
}
