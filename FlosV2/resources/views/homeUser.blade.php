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
            <p>Witaj, {{ Auth::user()->name}}, {{ Auth::user()->email }}<br></p>
            <button class="btn btn-primary" type="button" onclick="window.location='{{ url("user:list") }}'">Lista Zamówień</button>
            <table style="width:120%;text-align:center">
              <tr>
                <td><a href="\neworder">Nowe zamowienie</a></td>
              </tr>

            </table>

            @isset($orderList)
            <table>
              <tr>
                <th>ID</th>
                <th>STOLIK</th>
                <th>CENA</th>
              </tr>
                @foreach($orderList as $data)
                  <tr>
                    <td>{{$data->id}}</td>
                    <td>{{$data->tabl}}</td>
                    <td>{{$data->price}}</td>

                    <td>
                      <form method="post" action="{{{ route('delete_order') }}}">
                        @csrf
                        <input type="hidden" name="order_id" value="{{{ $data->id }}}">
                        <input type="hidden" name="table" value="{{{ $data->tabl }}}">
                        <input type="hidden" name="price" value="{{{ $data->price }}}">
                        <input type="submit" class="btn btn-danger" value="Usuń">
                      </form>
                    </td>
                  </tr>
                @endforeach
            </table>
            @endisset

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
