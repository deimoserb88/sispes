@extends('layouts.docente')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Fechas programadas</div>                
                <div class="panel-body">
                    <table class="table table-striped">
                        @foreach($periodos as $p)
                            <tr>
                                <td>{{ gettype($p->pde) }}</td>
                                <td>..</td>
                            </tr> 
                        @endforeach   
                    </table>


                </div>
                <div class="panel-footer">...</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Prácticas realizadas</div>                
                <div class="panel-body">...</div>
                <div class="panel-footer">...</div>
            </div>
        </div>
    </div>
</div>
@endsection