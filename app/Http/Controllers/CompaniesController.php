<?php

namespace App\Http\Controllers;

use App\Http\Requests\Companies\StoreCompanyRequest;
use Illuminate\Http\Request;

use App\Company;
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

    return redirect('admin/companies');
  }
}
