<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class ItemTest extends TestCase
{
  use DatabaseTransactions;

  public function testAdminCanSeeItemView()
  {
    $user = User::where('name', '=', 'Terry Ferreira')->get()->first();

    $this->actingAs($user)
         ->visit('/admin/items')
         ->seePageIs('/admin/items')
         ->see('Items');
  }

  public function testCustomerCannotSeeItemView()
  {
    $user = User::where('name', '=', 'John Doe')->get()->first();

    $this->actingAs($user)
         ->get('/admin/items')
         ->assertResponseStatus('403');
  }

  public function testCreateNewItem()
  {
    $user = User::where('name', '=', 'Terry Ferreira')->get()->first();

    $this->actingAs($user)
         ->visit('/admin/items')
         ->seePageIs('/admin/items')
         ->see('Create New Item')
         ->type('789', 'item_code')
         ->type('Full Chicken', 'description')
         ->press('Add New Item')
         ->seePageIs('/admin/items')
         ->see('Item: 789 - Full Chicken')
         ->see('Successfully created')
         ->seeInDatabase('items', ['item_code' => '789', 'description' => 'Full Chicken']);
  }

  public function testEditItem()
  {
    $user = User::where('name', '=', 'Terry Ferreira')->get()->first();

    $this->actingAs($user)
         ->visit('/admin/items')
         ->seePageIs('/admin/items')
         ->see('Create New Item')
         ->type('789', 'item_code')
         ->type('Full Chicken', 'description')
         ->press('Add New Item')
         ->seePageIs('/admin/items')
         ->see('Item: 789 - Full Chicken')
         ->see('Successfully created')
         ->seeInDatabase('items', ['item_code' => '789', 'description' => 'Full Chicken']);

    $item = App\Item::get()->last();

    $this->actingAs($user)
         ->visit('/admin/items/' . $item->id . '/edit')
         ->seePageIs('/admin/items/' . $item->id . '/edit')
         ->see('Full Chicken')
         ->type('Quarter Chicken', 'description')
         ->press('Edit Item')
         ->seePageIs('/admin/items')
         ->see('Item: 789 - Quarter Chicken')
         ->see('Successfully updated')
         ->seeInDatabase('items', ['item_code' => '789', 'description' => 'Quarter Chicken']);
  }
}
