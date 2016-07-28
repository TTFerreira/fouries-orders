<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class ItemTest extends TestCase
{
  use DatabaseTransactions;

  public function testSuperAdminCanSeeItemView()
  {
    $user = User::where('name', '=', 'Super Admin User')->get()->first();

    $this->actingAs($user)
         ->visit('/admin/items')
         ->seePageIs('/admin/items')
         ->see('Items');
  }

  public function testCustomerCannotSeeItemView()
  {
    $user = User::where('name', '=', 'Customer User')->get()->first();

    $this->actingAs($user)
         ->get('/admin/items')
         ->assertResponseStatus('403');
  }

  public function testSuperAdminCanCreateNewItem()
  {
    $user = User::where('name', '=', 'Super Admin User')->get()->first();

    $this->actingAs($user)
         ->visit('/admin/items')
         ->seePageIs('/admin/items')
         ->see('Create New Item')
         ->type('321', 'item_code')
         ->type('Full Chicken', 'description')
         ->select(1, 'item_category_id')
         ->press('Add New Item')
         ->seePageIs('/admin/items')
         ->see('Item: 321 - Full Chicken')
         ->see('Successfully created')
         ->seeInDatabase('items', ['item_code' => '321', 'description' => 'Full Chicken', 'item_category_id' => 1]);
  }

  public function testSuperAdminCanEditItem()
  {
    $user = User::where('name', '=', 'Super Admin User')->get()->first();

    $this->actingAs($user)
         ->visit('/admin/items')
         ->seePageIs('/admin/items')
         ->see('Create New Item')
         ->type('321', 'item_code')
         ->type('Full Chicken', 'description')
         ->select(1, 'item_category_id')
         ->press('Add New Item')
         ->seePageIs('/admin/items')
         ->see('Item: 321 - Full Chicken')
         ->see('Successfully created')
         ->seeInDatabase('items', ['item_code' => '321', 'description' => 'Full Chicken', 'item_category_id' => 1]);

    $item = App\Item::get()->last();

    $this->actingAs($user)
         ->visit('/admin/items/' . $item->id . '/edit')
         ->seePageIs('/admin/items/' . $item->id . '/edit')
         ->see('Full Chicken')
         ->type('Quarter Chicken', 'description')
         ->select(2, 'item_category_id')
         ->press('Edit Item')
         ->seePageIs('/admin/items')
         ->see('Item: 321 - Quarter Chicken')
         ->see('Successfully updated')
         ->seeInDatabase('items', ['item_code' => '321', 'description' => 'Quarter Chicken', 'item_category_id' => 2]);
  }
}
