@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            Strona domowa
          </div>
          <div class="card-body">
            Strona zalogowanego użytkownika z rolą: user
            {{ Auth::user()->email }}

            @if(Auth::user()->role=='admin')
              <a href="\admin">Administracja</a>
            @endif

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
