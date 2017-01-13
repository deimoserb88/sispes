@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Panel de actividades</div>
                <div class="panel-body">
                    {{-- Session::get('id_ciclo') --}}
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="/rootFechas">Fechas</a></li>
                        <li><a href="/rootPP">Prácticas programadas</a></li>
                        <li><a href="/rootPR">Prácticas realizadas</a></li>
                        <li><a href="{{ url('/cicloSeleccionar') }}">Cambiar ciclo</a></li>                    
                    </ul>
                </div>
                <div class="panel-footer"></div>
            </div>
        </div>
    </div>
</div>
@endsection