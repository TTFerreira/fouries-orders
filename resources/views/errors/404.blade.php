@extends('layouts.app')

@section('htmlheader_title')
    Page not found
@endsection

@section('contentheader_title')
    404 Error Page
@endsection

@section('$contentheader_description')
@endsection

@section('main-content')

<div class="error-page">
    <h2 class="headline text-yellow"> 404</h2>
    <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
        <p>
            We could not find the page you were looking for.
            You may <a href='{{ url('/home') }}'>return to dashboard</a> or click back to return to the page you came from.
        </p>
        <a class="btn btn-primary" href="{{ URL::previous() }}"><b>Back</b></a>
    </div><!-- /.error-content -->
</div><!-- /.error-page -->
@endsection
