@extends('layouts.app')

@section('content')

<div class="container" style="float:center ;">
    <div class="col-sm-12">

        <h3 class="text-center">Formularios</h3>
        <div class="card-body">
            <form action="{{ '/auditoria' }}" method="GET">

                <label for="estrategia"><i class="bi bi-journal-text"></i>Estrategia</label>
                <select name="id" id="" class="form-select form-select-sm select-month me-2">
                    @foreach ($estrategia as $estra)
                    <option value="{{$estra->id}}">{{$estra->estrategia}}</option>
                    @endforeach
                </select><br>
                <button type="submit" class="btn btn-outline-dark"><i class="bi bi-search"></i>Buscar</button>
            </form>
        </div>

    </div>
</div>
<br><br>

@can('admin', auth()->user())
<a class="d-block border rounded-2">admin</a>
@endcan

<div class="container">
    <div class="row row-cols-2 row-cols-lg-6 g-2 g-lg-3">
        @foreach ($estrategia as $estra)
        <div class="col-md-2">
            <strong>
            
                <a class="d-block border rounded-2" href="{{ route('auditoria', ['id' => $estra->id]) }}">
                    <i class="bi bi-journal-text" style="font-size: 3rem; color: cornflowerblue;"></i>
                    <br>{{$estra->estrategia}}</a></strong>
        </div>
        @endforeach
    </div>
</div>

@endsection