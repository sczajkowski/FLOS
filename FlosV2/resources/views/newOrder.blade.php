@extends('layouts.app')

@section('content')
@if(isset(Auth::user()->role))
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            Strona zamowienia
            <form method="POST" action="{{ route('makeNewOrder') }}">
                @csrf


                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Stolik') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="number" name="table" required autocomplete="id">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ __('Dalej') }}
                </button>

            </form>
          </div>
          <div class="card-body">

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@endif
