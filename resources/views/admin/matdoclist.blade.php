@extends('layouts.admin')

@section('estilos')
    {{ Html::style('/public/assets/vendor/datatables/media/css/dataTables.bootstrap.min.css') }}
@endsection

@section('content')

   
<div class="container" style="width: 80%;">
    <form action="{{ url('/materiasPracticas') }}" method="post">
    {{ csrf_field() }}
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4>Materias registradas para el ciclo: {{ $ciclo->first()->desc }}</h4>
        </div>

        <div class="panel-body">
            <table class="table table-striped" id="tdatos">
                <thead>
                    <tr>                        
                        <th>Id</th>
                        <th>Materia</th>
                        <th>Docente</th>
                        <th>Grupo</th>
                        <th>Plan</th>
                        <th>Prácticas</th>
                    </tr>
                </thead>
                <tbody>      
                    @foreach($MD as $registro)                  
                        <tr>
                            <td>{{ $registro['id'] }}</td>
                            <td>{{ $registro['mat'] }}</td>
                            <td>{{ $registro['doc'] }}</td>
                            <td>{{ $registro['gpo'] }}</td>
                            <td>{{ $registro['plan'] }}</td>
                            <td>
                            <div class="has-success">
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" class="si" checked="checked" name="si[]" id="si{{ $registro['id'] }}" value="{{ $registro['id'] }}">
                                  <span  class="label label-success" id="l{{ $registro['id'] }}">SI</span>
                                </label>
                              </div>
                            </div>
                            </td>
                        </tr>                  
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-10">
                    <p class="alert alert-warning">
                    Desmarque la casilla de todas aquellas materias que no realicen prácticas de laboratorio.<br>               
                    Si no está seguro, lo puede hacer mas tarde. 
                    </p>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success">Guardar <i class="fa fa-download"  aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>

@endsection

@section('scripts')


{{ Html::script('/public/assets/vendor/datatables/media/js/jquery.dataTables.min.js') }}
{{ Html::script('/public/assets/vendor/datatables/media/js/dataTables.bootstrap.min.js') }}

<script type="text/javascript">

    $(document).ready(function() {     
        
        $('.si').click(function(){
            if($(this).prop("checked")){
                $("#l"+$(this).val())
                    .addClass("label-success")
                    .removeClass("label-danger")
                    .text("SI");
            }else{
                $("#l"+$(this).val())
                    .removeClass("label-success")
                    .addClass("label-danger")
                    .text("NO");  
            }
        });

        $('#tdatos').DataTable({
            "scrollY": 480,
            "scrollCollapse": true,
            "paging": false,
            "info": false,
            "language": {
                "search": "Filtrar:",
                "zeroRecords": "No se encontraron registros que coincidan",
            },
            "select": true,
            "emptyTable" : "No hay datos para mostrar",
            "columnDefs": [
                { "orderable": false, "targets": 5 }
            ],             
        });

    });    
</script>

@endsection