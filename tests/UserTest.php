<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class UserTest extends TestCase
{
  use DatabaseTransactions;

  public function testAdminCanSeeAdminView()
  {
    $user = User::where('name', '=', 'Terry Ferreira')->get()->first();

    $this->actingAs($user)
         ->visit('/admin')
         ->seePageIs('/admin')
         ->see('User Management');
  }

  public function testCustomerCannotSeeAdminViewOrMenuItem()
  {
    $user = User::where('name', '=', 'John Doe')->get()->first();

    $this->actingAs($user)
         ->get('/admin')
         ->assertResponseStatus('403');

    $this->visit('/')
         ->dontSee('Administrator');
  }
}
