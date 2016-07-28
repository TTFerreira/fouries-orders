<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Company;

class CompanyTest extends TestCase
{
    use DatabaseTransactions;

    public function testCustomerCannotSeeCompaniesView()
    {
      $user = User::where('name', '=', 'Customer User')->get()->first();

      $this->actingAs($user)
           ->get('/admin/companies')
           ->assertResponseStatus('403');
    }

    public function testSuperAdminCanSeeCompaniesView()
    {
      $user = User::where('name', '=', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/admin/companies')
           ->seePageIs('/admin/companies')
           ->see('Companies');
    }

    public function testSuperAdminCanCreateCompany()
    {
      $user = User::where('name', '=', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/admin/companies')
           ->see('Create New Company')
           ->type('Random Name', 'name')
           ->type('018 1234 567', 'telephone')
           ->type('018 9876 543', 'fax')
           ->type('12345678', 'vat')
           ->type('123', 'street_number')
           ->type('Main Street', 'street_name')
           ->type('Potchefstroom', 'city')
           ->type('2531', 'postal_code')
           ->type('South Africa', 'country')
           ->press('Add New Company')
           ->seePageIs('/admin/companies')
           ->see('Random Name')
           ->see('Company: Random Name')
           ->see('Successfully created')
           ->seeInDatabase('companies', ['name' => 'Random Name', 'telephone' => '018 1234 567', 'fax' => '018 9876 543', 'vat' => '12345678', 'street_number' => '123', 'city' => 'Potchefstroom', 'postal_code' => '2531', 'country' => 'South Africa']);
    }

    public function testSuperAdminCanEditCompany()
    {
      $user = User::where('name', '=', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/admin/companies')
           ->see('Create New Company')
           ->type('Random Name', 'name')
           ->type('018 1234 567', 'telephone')
           ->type('018 9876 543', 'fax')
           ->type('12345678', 'vat')
           ->type('123', 'street_number')
           ->type('Main Street', 'street_name')
           ->type('Potchefstroom', 'city')
           ->type('2531', 'postal_code')
           ->type('South Africa', 'country')
           ->press('Add New Company')
           ->seePageIs('/admin/companies')
           ->see('Random Name')
           ->see('Company: Random Name')
           ->see('Successfully created')
           ->seeInDatabase('companies', ['name' => 'Random Name', 'telephone' => '018 1234 567', 'fax' => '018 9876 543', 'vat' => '12345678', 'street_number' => '123', 'city' => 'Potchefstroom', 'postal_code' => '2531', 'country' => 'South Africa']);

      $company = Company::get()->last();

      $this->actingAs($user)
           ->visit('/admin/companies/' . $company->id . '/edit')
           ->seePageIs('/admin/companies/' . $company->id . '/edit')
           ->see('Random Name')
           ->type('Different Name', 'name')
           ->press('Edit Company')
           ->seePageIs('/admin/companies')
           ->see('Company: Different Name')
           ->see('Successfully updated')
           ->seeInDatabase('companies', ['name' => 'Different Name', 'telephone' => '018 1234 567', 'fax' => '018 9876 543', 'vat' => '12345678', 'street_number' => '123', 'city' => 'Potchefstroom', 'postal_code' => '2531', 'country' => 'South Africa']);
    }
}
