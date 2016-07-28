<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class UserTest extends TestCase
{
  use DatabaseTransactions;

  public function testSuperAdminCanSeeAdminView()
  {
    $user = User::where('name', '=', 'Super Admin User')->get()->first();

    $this->actingAs($user)
         ->visit('/admin')
         ->seePageIs('/admin')
         ->see('User Management');
  }

  public function testAdminCanSeeAdminView()
  {
    $user = User::where('name', '=', 'Admin User')->get()->first();

    $this->actingAs($user)
         ->visit('/admin')
         ->seePageIs('/admin')
         ->see('User Management');
  }

  public function testCustomerCannotSeeAdminViewOrMenuItem()
  {
    $user = User::where('name', '=', 'Customer User')->get()->first();

    $this->actingAs($user)
         ->get('/admin')
         ->assertResponseStatus('403');

    $this->visit('/')
         ->dontSee('Administrator');
  }

  public function testSuperAdminCanCreateNewUser()
  {
    $user = User::where('name', '=', 'Super Admin User')->get()->first();

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

  public function testSuperAdminCanEditUser()
  {
    $user = User::where('name', '=', 'Super Admin User')->get()->first();

    $this->actingAs($user)
         ->visit('/admin/users/' . $user->id . '/edit')
         ->seePageIs('/admin/users/' . $user->id . '/edit')
         ->type('James Doe', 'name')
         ->type('jamesdoe@terryferreira.com', 'email')
         ->select(4, 'company_id')
         ->press('Edit User')
         ->seePageIs('/admin/users')
         ->see('User: James Doe')
         ->see('Successfully updated')
         ->seeInDatabase('users', ['name' => 'James Doe', 'email' => 'jamesdoe@terryferreira.com', 'company_id' => 4]);
  }

  public function testAdminCannotChangeUserRole()
  {
    $user = User::where('name', '=', 'Admin User')->get()->first();

    $this->actingAs($user)
         ->visit('/admin/users/' . $user->id . '/edit')
         ->seePageIs('/admin/users/' . $user->id . '/edit')
         ->see('Admin User')
         ->dontSee('User\'s Role');
  }

  public function testSuperAdminCanChangeUserRole()
  {
    $user = User::where('name', '=', 'Super Admin User')->get()->first();
    $user2 = User::where('name', '=', 'Customer User')->get()->first();

    $this->actingAs($user)
         ->visit('/admin/users/' . $user2->id . '/edit')
         ->seePageIs('/admin/users/' . $user2->id . '/edit')
         ->see('Customer User')
         ->select(2, 'role_id')
         ->press('Edit User')
         ->seePageIs('/admin/users')
         ->see('Successfully updated')
         ->seeInDatabase('role_user', ['user_id' => $user2->id, 'role_id' => 2]);
  }

  public function testCannotChangeRoleIfOnlyOneSuperAdmin()
  {
    $user = User::where('name', '=', 'Super Admin User')->get()->first();

    $this->actingAs($user)
         ->visit('/admin/users/' . $user->id . '/edit')
         ->seePageIs('/admin/users/' . $user->id . '/edit')
         ->select(2, 'role_id')
         ->press('Edit User')
         ->seePageIs('/admin/users/' . $user->id . '/edit')
         ->see('Cannot change role')
         ->seeInDatabase('role_user', ['user_id' => $user->id, 'role_id' => 1]);
  }
}
