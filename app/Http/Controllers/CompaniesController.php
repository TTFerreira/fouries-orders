<?php

namespace App\Http\Controllers;

use App\Http\Requests\Companies\StoreCompanyRequest;
use App\Http\Requests\Companies\UpdateCompanyRequest;
use Illuminate\Http\Request;

use App\Company;
use Session;
use App\Http\Requests;

class CompaniesController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $pageTitle = 'Companies';
    $companies = Company::all();
    return view('admin.companies.index', compact('pageTitle', 'companies'));
  }

  public function store(StoreCompanyRequest $request)
  {
    Company::create($request->all());

    Session::flash('status', 'success');
    Session::flash('title', 'Company: ' . $request->name);
    Session::flash('message', 'Successfully created');

    return redirect('admin/companies');
  }

  public function edit(Company $company)
  {
    $pageTitle = 'Edit Company - ' . $company->name;
    return view('admin.companies.edit', compact('pageTitle', 'company'));
  }

  public function update(UpdateCompanyRequest $request, Company $company)
  {
    $company->update($request->all());

    Session::flash('status', 'success');
    Session::flash('title', 'Company: ' . $request->name);
    Session::flash('message', 'Successfully updated');

    return redirect('/admin/companies');
  }
}
