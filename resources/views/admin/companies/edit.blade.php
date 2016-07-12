@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="/admin/companies/{{$company->id}}">
            {{method_field('PATCH')}}
            {{csrf_field()}}
            <div class="form-group {{ hasErrorForClass($errors, 'name') }}">
              <label for="name">Name</label>
              <input type="text" name="name" class="form-control" value="{{$company->name}}">
              {{ hasErrorForField($errors, 'name') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'telephone') }}">
              <label for="telephone">Telephone</label>
              <input type="text" name="telephone" class="form-control" value="{{$company->telephone}}">
              {{ hasErrorForField($errors, 'telephone') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'fax') }}">
              <label for="fax">Fax</label>
              <input type="text" name="fax" class="form-control" value="{{$company->fax}}">
              {{ hasErrorForField($errors, 'fax') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'vat') }}">
              <label for="vat">VAT</label>
              <input type="text" name="vat" class="form-control" value="{{$company->vat}}">
              {{ hasErrorForField($errors, 'vat') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'street_number') }}">
              <label for="street_number">Street Number</label>
              <input type="text" name="street_number" class="form-control" value="{{$company->street_number}}">
              {{ hasErrorForField($errors, 'street_number') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'street_name') }}">
              <label for="street_name">Street Name</label>
              <input type="text" name="street_name" class="form-control" value="{{$company->street_name}}">
              {{ hasErrorForField($errors, 'street_name') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'city') }}">
              <label for="city">City</label>
              <input type="text" name="city" class="form-control" value="{{$company->city}}">
              {{ hasErrorForField($errors, 'city') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'postal_code') }}">
              <label for="postal_code">Postal Code</label>
              <input type="text" name="postal_code" class="form-control" value="{{$company->postal_code}}">
              {{ hasErrorForField($errors, 'postal_code') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'country') }}">
              <label for="country">Country</label>
              <input type="text" name="country" class="form-control" value="{{$company->country}}">
              {{ hasErrorForField($errors, 'country') }}
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary"><b>Edit Company</b></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
