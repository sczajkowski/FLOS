@extends('layouts.app')
@if((Auth::user()->role)=='admin')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            Strona domowa
          </div>
          <div class="card-body">
            Strona zalogowanego użytkownika z rolą: admin
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@endif