@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            {{-- <form action="{{ url('/cicloFijar') }}" class="form-horizontal"> --}}
            {{ Form::open(['url'=>'/cicloFijar','method'=>'post','class'=>'form-horizontal']) }}
                <div class="panel panel-primary">
                    <div class="panel-heading">Seleccionar ciclo de trabajo</div>
                    <div class="panel-body">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <select name="ciclo" id="ciclo" class="form-controler">
                                    @foreach($ciclos as $c)
                                        <option value="{{ $c->id }}" @if($c->activo) selected="selected" @endif>{{ $c->desc}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ciclo_activo" value="1"> Establecer como ciclo activo para todos
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <button class="btn btn-success btn-block" type="submit">Aceptar <i class="fa fa-check" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection