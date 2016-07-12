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
         ->see('User Management');
  }

  public function testEditUserView()
  {
    $user = User::where('name', '=', 'Terry Ferreira')->get()->first();

    $this->actingAs($user)
         ->visit('/admin')
         ->click('Users')
         ->seePageIs('/admin/users')
         ->see('Users')
         ->see('Terry Ferreira')
         ->see('John Doe');
  }

  public function testEditExistingUser()
  {
    $user = User::where('name', '=', 'Terry Ferreira')->get()->first();

    $this->actingAs($user)
         ->visit('/admin/users/' . $user->id . '/edit')
         ->see('Terry Ferreira')
         ->dontSee('John Doe')
         ->type('johndoe@pixelcandy.co.za', 'email')
         ->press('Edit User')
         ->see('johndoe@pixelcandy.co.za already exists.')
         ->type('Terry Ferreira 2', 'name')
         ->press('Edit User')
         ->seePageIs('admin/users')
         ->see('Terry Ferreira 2');
  }
}
