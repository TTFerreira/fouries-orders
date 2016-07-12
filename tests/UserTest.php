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

  public function testCreateNewUser()
  {
    $user = User::where('name', '=', 'Terry Ferreira')->get()->first();

    $this->actingAs($user)
         ->visit('/admin/users')
         ->see('Create New User')
         ->type('Random Name', 'name')
         ->type('random@pixelcandy.co.za', 'email')
         ->type('secret', 'password')
         ->select(3, 'company_id')
         ->press('Add New User')
         ->seePageIs('/admin/users')
         ->see('User: Random Name')
         ->see('Successfully created')
         ->seeInDatabase('users', ['name' => 'Random Name', 'email' => 'random@pixelcandy.co.za', 'company_id' => 3]);
  }

  public function testEditUser()
  {
    $user = User::where('name', '=', 'Terry Ferreira')->get()->first();

    $this->actingAs($user)
         ->visit('/admin/users/' . $user->id . '/edit')
         ->seePageIs('/admin/users/' . $user->id . '/edit')
         ->type('Jane Doe', 'name')
         ->type('janedoe@pixelcandy.co.za', 'email')
         ->select(4, 'company_id')
         ->press('Edit User')
         ->seePageIs('/admin/users')
         ->see('User: Jane Doe')
         ->see('Successfully updated')
         ->seeInDatabase('users', ['name' => 'Jane Doe', 'email' => 'janedoe@pixelcandy.co.za', 'company_id' => 4]);
  }
}
