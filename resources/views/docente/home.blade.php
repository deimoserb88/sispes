@extends('layouts.docente')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Fechas programadas</div>                
                <div class="panel-body">
                    <table class="table table-striped">
                        <tr><th>Concepto</th><th class="text-center">Fecha de cierre de captura</th></tr>
                        @foreach($periodos as $p)
                            <tr>
                                <td>{{ sispes\Periodo::clavesPeriodos($p->tipo) }}</td>
                                <td class="text-center"><?php 
                                        $f = explode("-",$p->pde);
                                        echo $f[2]." - ".sispes\Periodo::mes((int)$f[1])." - ".$f[0];
                                    ?></td>
                            </tr> 
                        @endforeach   
                    </table>
                </div>
                <div class="panel-footer"></div>
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