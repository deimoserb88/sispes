@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Panel de actividades del responsable de plantel</div>

                <div class="panel-body">
                    {{ $plantA }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection