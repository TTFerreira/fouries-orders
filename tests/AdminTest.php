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

  public function testAdminViewWithSuperAdminUser()
  {
    $user = User::where('name', '=', 'Super Admin User')->get()->first();

    $this->actingAs($user)
         ->visit('/admin')
         ->see('User Management');
  }

  public function testSuperAdminCanViewEditUserView()
  {
    $user = User::where('name', '=', 'Super Admin User')->get()->first();

    $this->actingAs($user)
         ->visit('/admin')
         ->click('Users')
         ->seePageIs('/admin/users')
         ->see('Users')
         ->see('Super Admin User')
         ->see('Customer User');
  }

  public function testSuperAdminCanEditExistingUser()
  {
    $user = User::where('name', '=', 'Super Admin User')->get()->first();

    $this->actingAs($user)
         ->visit('/admin/users/' . $user->id . '/edit')
         ->see('Super Admin User')
         ->dontSee('Customer User')
         ->type('customeruser@terryferreira.com', 'email')
         ->press('Edit User')
         ->see('customeruser@terryferreira.com already exists.')
         ->type('Super Admin User 2', 'name')
         ->press('Edit User')
         ->seePageIs('admin/users')
         ->see('Super Admin User 2');
  }
}
