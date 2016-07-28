<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Order;
use App\OrderItem;

class OrderTest extends TestCase
{
  use DatabaseTransactions;

  public function testCustomerCanViewOrdersView()
  {
    $user = User::where('name', '=', 'Customer User')->first();

    $this->actingAs($user)
         ->visit('/orders')
         ->see('Orders');
  }

  public function testCustomerCanSeeOnlyTheirCompanyOrdersOnOrdersIndex()
  {
    $user = User::where('name', 'Customer User')->first();
    $companyUsers = User::where('company_id', $user->company_id)->pluck('id');
    $companyOrder = Order::whereIn('user_id', $companyUsers)->first();
    $notCompanyOrder = Order::whereNotIn('user_id', $companyUsers)->first();

    $this->actingAs($user)
         ->visit('/orders')
         ->see('Orders')
         ->see($companyOrder->user->company->name)
         ->dontSee($notCompanyOrder->user->company->name);
  }

  public function testCustomerCanShowTheirCompanyOrder()
  {
    $user = User::where('name', 'Customer User')->first();
    $companyUsers = User::where('company_id', $user->company_id)->pluck('id');
    $companyOrder = Order::whereIn('user_id', $companyUsers)->first();
    $orderItem = OrderItem::where('order_id', $companyOrder->id)->first();

    $this->actingAs($user)
         ->visit('/orders/' . $companyOrder->id)
         ->seePageIs('/orders/' . $companyOrder->id)
         ->see($orderItem->item->item_code)
         ->see($orderItem->quantity)
         ->see($orderItem->item->description);
  }

  public function testCustomerCannotShowOtherCompanyOrder()
  {
    $user = User::where('name', 'Customer User')->first();
    $companyUsers = User::where('company_id', $user->company_id)->pluck('id');
    $otherCompanyOrder = Order::whereNotIn('user_id', $companyUsers)->first();

    $this->actingAs($user)
         ->get('/orders/' . $otherCompanyOrder->id)
         ->assertResponseStatus('403');
  }

  public function testAdminsCanSeeOrdersFromAllCompaniesOnOrdersIndex()
  {
    $user = User::where('name', 'Admin User')->first();
    $companyUsers = User::where('company_id', $user->company_id)->pluck('id');
    $companyOrder = Order::whereIn('user_id', $companyUsers)->first();
    $notCompanyOrder = Order::whereNotIn('user_id', $companyUsers)->first();

    $this->actingAs($user)
         ->visit('/orders')
         ->see('Orders')
         ->see($companyOrder->user->company->name)
         ->see($notCompanyOrder->user->company->name);
  }

  public function testSuperAdminCanSeeOrdersFromAllCompaniesOnOrdersIndex()
  {
    $user = User::where('name', 'Super Admin User')->first();
    $companyUsers = User::where('company_id', $user->company_id)->pluck('id');
    $companyOrder = Order::whereIn('user_id', $companyUsers)->first();
    $notCompanyOrder = Order::whereNotIn('user_id', $companyUsers)->first();

    $this->actingAs($user)
         ->visit('/orders')
         ->see('Orders')
         ->see($companyOrder->user->company->name)
         ->see($notCompanyOrder->user->company->name);
  }

  public function testAdminCanShowAnyCompanyOrder()
  {
    $user = User::where('name', 'Admin User')->first();
    $companyUsers = User::where('company_id', $user->company_id)->pluck('id');
    $companyOrder = Order::whereIn('user_id', $companyUsers)->first();
    $otherCompanyOrder = Order::whereNotIn('user_id', $companyUsers)->first();
    $companyOrderItem = OrderItem::where('order_id', $companyOrder->id)->first();
    $otherCompanyOrderItem = OrderItem::where('order_id', $otherCompanyOrder->id)->first();

    $this->actingAs($user)
         ->visit('/orders/' . $companyOrder->id)
         ->seePageIs('/orders/' . $companyOrder->id)
         ->see($companyOrderItem->item->item_code)
         ->see($companyOrderItem->quantity)
         ->see($companyOrderItem->item->description)
         ->visit('/orders/' . $otherCompanyOrder->id)
         ->seePageIs('/orders/' . $otherCompanyOrder->id)
         ->see($otherCompanyOrderItem->item->item_code)
         ->see($otherCompanyOrderItem->quantity)
         ->see($otherCompanyOrderItem->item->description);
  }

  public function testSuperAdminCanShowAnyCompanyOrder()
  {
    $user = User::where('name', 'Super Admin User')->first();
    $companyUsers = User::where('company_id', $user->company_id)->pluck('id');
    $companyOrder = Order::whereIn('user_id', $companyUsers)->first();
    $otherCompanyOrder = Order::whereNotIn('user_id', $companyUsers)->first();
    $companyOrderItem = OrderItem::where('order_id', $companyOrder->id)->first();
    $otherCompanyOrderItem = OrderItem::where('order_id', $otherCompanyOrder->id)->first();

    $this->actingAs($user)
         ->visit('/orders/' . $companyOrder->id)
         ->seePageIs('/orders/' . $companyOrder->id)
         ->see($companyOrderItem->item->item_code)
         ->see($companyOrderItem->quantity)
         ->see($companyOrderItem->item->description)
         ->visit('/orders/' . $otherCompanyOrder->id)
         ->seePageIs('/orders/' . $otherCompanyOrder->id)
         ->see($otherCompanyOrderItem->item->item_code)
         ->see($otherCompanyOrderItem->quantity)
         ->see($otherCompanyOrderItem->item->description);
  }

  public function testCustomerCanUpdateOrderStatus()
  {
    $user = User::where('name', 'Customer User')->first();
    $companyUsers = User::where('company_id', $user->company_id)->pluck('id');
    $companyOrder = Order::whereIn('user_id', $companyUsers)->first();
    $orderItem = OrderItem::where('order_id', $companyOrder->id)->first();

    $this->actingAs($user)
         ->visit('/orders/' . $companyOrder->id)
         ->seePageIs('/orders/' . $companyOrder->id)
         ->see($orderItem->item->item_code)
         ->see($orderItem->quantity)
         ->see($orderItem->item->description)
         ->select(3, 'status')
         ->press('Update Status');

    $updatedCompanyOrder = Order::where('id', $companyOrder->id)->first();

    $this->actingAs($user)
         ->see('Order: ' . $companyOrder->id . ' for ' . $companyOrder->user->company->name)
         ->see('Status changed to: ' . $updatedCompanyOrder->orderupdate->status->status);
  }
}
