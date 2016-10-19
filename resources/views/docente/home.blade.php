@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Panel de actividades del docente</div>

                <div class="panel-body">
                    {{ $plantel }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection