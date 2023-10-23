@extends('layouts.app')

@section('content')
<br><br>

<h3 class="text-center">Últimos Registros</h3>
<br><br>
<div class="container">
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Fecha</th>
        <th scope="col">Servicio</th>
        <th scope="col">Estrategia</th>        
        <th scope="col">Cargo</th>
        <th scope="col">Auditor</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($datares as $data)
      <tr>
        <td>{{\Carbon\Carbon::parse($data->fecha)->format('d/m/Y' )}}</td>
        <td>{{$data->servicio}}</td>
        <td>{{$data->estrategia}}</td>
        <td>{{$data->cargo}}</td>
        <td>{{$data->auditor}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <br><br>

  {{$datares->links()}}


</div>


@endsection