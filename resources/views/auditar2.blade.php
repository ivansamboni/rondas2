@extends('layouts.app')

@section('content')

<div class="col-xs-1-12">
   
    <div class="card">
        <div class="card-body">
            <br>
            
                <h3 class="text-center"><strong>{{$estra->estrategia}}</strong></h3>
           
            <br>
            <form action="{{ '/enviar' }}" method="POST">
            
           <input type="text" name="estrategia" hidden value="{{$estra->estrategia}}"> 
               @csrf
            <center>
                <input type="text" name="auditor" hidden value="{{ Auth::user()->name }}">
                <label for="servicio">Servicio</label>
                <select name="servicio" id="" class="form-control" required>
                    <option value="">Seleccione Servicio</option>
                    @foreach ($servicio as $serv)
                    <option value="{{$serv->servicio}}">{{$serv->servicio}}</option>
                    @endforeach                    
                </select>
            <br>
                <label for="cargo">Cargo</label>
                <select name="cargo" id="" class="form-control" required>
                    <option value="">Seleccione Cargo</option>
                    @foreach ($cargo as $car)
                    <option value="{{$car->cargo}}">{{$car->cargo}}</option>
                    @endforeach  
                </select>
                </center>
                <br><br>
                <hr><hr>

                @foreach ($item as $ite)
                <h7><strong>{{$ite->item}}</strong></h7>
                <input type="text" name="pregunta[]" value="{{$ite->item}}" hidden>
                <select name="respuesta[]" id="" class="form-control" required>
                    <option value="">Seleccione</option>
                    <option value="NA">N/A</option>
                    <option style="color:green;" value="C">C</option>
                    <option style="color:red;" value="NC">NC</option>
                </select>

                <br>
                <hr>
                @endforeach
                <label for="observacion">Observación:</label>
                <textarea name="observacion" id="" rows="3" class="form-control"></textarea>
                <br>

                <button type="submit" class="btn btn-outline-dark form-control">Enviar</button>
            </form>


        </div>
    </div>
</div>










@endsection