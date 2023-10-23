@extends('layouts.app')

@section('content')
<br><br>
<h3 class="text-center">Observaciones</h3>

<br><br>
<div class="container">
<table class="table table-striped">
          <thead>
            <tr>
                <th>Observación</th>
                <th>Servicio</th>
                <th>Cargo</th>
                <th>Estrategia</th>
                <th>Auditor</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>@foreach ($observaciones as $data)        
            <tr>
                <td>{{$data->observacion}}</td>
                <td>{{$data->servicio}}</td>
                <td>{{$data->cargo}}</td>
                <td>{{$data->estrategia}}</td>
                <td>{{$data->auditor}}</td>
                <td>{{\Carbon\Carbon::parse($data->fecha)->format('d/m/Y')}}</td>
                @endforeach
            </tr>
        </tbody>
    </table>   
    <br>
    <br>
    {{$observaciones->links()}}     
</div>
@endsection