@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Seleccionar plantel de trabajo</div>
                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                    @foreach($des as $d)
                        <li  role="presentation" ><a href="{{ url('/selPlantel/'.$d->plant)}}">{{ $d->nomplant }}</a></li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection