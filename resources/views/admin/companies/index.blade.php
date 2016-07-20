@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <table id="table" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Telephone</th>
                <th>City</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($companies as $company)
                <tr>
                  <div>
                    <td>{{$company->name}}</td>
                    <td>{{$company->telephone}}</td>
                    <td>{{$company->city}}</td>
                    <td><a href="/admin/companies/{{ $company->id }}/edit" class="btn btn-primary"><span class='fa fa-edit' aria-hidden='true'></span> <b>Edit</b></a></td>
                  </div>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Create New Company</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="{{ url('admin/companies') }}">
            {{csrf_field()}}
            <div class="form-group {{ hasErrorForClass($errors, 'name') }}">
              <label for="name">Name</label>
              <input type="text" name="name" class="form-control" value="{{old('name')}}">
              {{ hasErrorForField($errors, 'name') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'telephone') }}">
              <label for="telephone">Telephone</label>
              <input type="text" name="telephone" class="form-control" value="{{old('telephone')}}">
              {{ hasErrorForField($errors, 'telephone') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'fax') }}">
              <label for="fax">Fax</label>
              <input type="text" name="fax" class="form-control" value="{{old('fax')}}">
              {{ hasErrorForField($errors, 'fax') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'vat') }}">
              <label for="vat">VAT Number</label>
              <input type="text" name="vat" class="form-control" value="{{old('vat')}}">
              {{ hasErrorForField($errors, 'vat') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'street_number') }}">
              <label for="street_number">Street Number</label>
              <input type="text" name="street_number" class="form-control" value="{{old('street_number')}}">
              {{ hasErrorForField($errors, 'street_number') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'street_name') }}">
              <label for="street_name">Street Name</label>
              <input type="text" name="street_name" class="form-control" value="{{old('street_name')}}">
              {{ hasErrorForField($errors, 'street_name') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'city') }}">
              <label for="city">City</label>
              <input type="text" name="city" class="form-control" value="{{old('city')}}">
              {{ hasErrorForField($errors, 'city') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'postal_code') }}">
              <label for="postal_code">Postal Code</label>
              <input type="text" name="postal_code" class="form-control" value="{{old('postal_code')}}">
              {{ hasErrorForField($errors, 'postal_code') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'country') }}">
              <label for="country">Country</label>
              <input type="text" name="country" class="form-control" value="{{old('country')}}">
              {{ hasErrorForField($errors, 'country') }}
            </div>

            **NOT DONE YET**

            <div class="form-group">
              <button type="submit" class="btn btn-primary"><b>Add New Company</b></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#table').DataTable( {
        columnDefs: [ {
          orderable: false, targets: 3
        } ],
        order: [[ 0, "asc" ]]
      } );
    } );
  </script>
  @if(Session::has('status'))
    <script>
      $(document).ready(function() {
        Command: toastr["{{Session::get('status')}}"]("{{Session::get('message')}}", "{{Session::get('title')}}");
      });
    </script>
  @endif
@endsection
