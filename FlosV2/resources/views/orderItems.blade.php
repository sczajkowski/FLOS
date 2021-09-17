@extends('layouts.app')

@section('content')
@if(isset(Auth::user()->role))
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            Zamówienie numer {{$order_id}}

            @isset($itemList)
            <table>
              <tr>
                <th>ID</th>
                <th>NAZWA</th>
                <th>CENA</th>
                <th>ILOSC</th>
                <th>SUMA</th>
              </tr>
                @foreach($itemList as $data)
                  <tr>
                    <td>{{$data->item_id}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->price}}</td>
                    <td>{{$data->quantity}}</td>
                    <td>{{$data->total_item_price}}</td>
                    <td>
                      <form method="post" action="{{{ route('delete_order_item') }}}">
                        @csrf
                        <input type="hidden" name="delete_id" value="{{{ $data->item_id }}}">
                        <input type="hidden" name="order_id" value="{{{ $order_id }}}">
                        <input type="hidden" name="quantity" value="{{{ $data->quantity }}}">
                        <input type="submit" class="btn btn-danger" value="Usuń">
                      </form>
                    </td>
                  </tr>
                @endforeach
            </table>
            @endisset


            <form method="POST" action="{{ route('addOrderItems') }}">
                @csrf

                <div class="form-group row">
                  <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Numer zamowienia') }}</label>

                  <div class="col-md-6">
                      <input id="email" type="number" name="order_id" value="{{$order_id}}"required autocomplete="id" readonly>

                      @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Numer dania :') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="number" name="item_id" required autocomplete="id">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Ilość') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="number" name="item_quantity" required autocomplete="id">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ __('Dodaj') }}
                </button>
                
            </form>
            <br>
            <form method="POST" action="{{ route('submitOrder') }}">
              @csrf
              <input type="hidden" name="order_id" value="{{{ $order_id }}}">
              <input type="submit" class="btn btn-primary" value="Gotowe">
            </form>

          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@endif
