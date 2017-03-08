@extends('layouts.admin')

@section('estilos')
    {{ Html::style('/public/assets/vendor/datatables/media/css/dataTables.bootstrap.min.css') }}
@endsection

@section('content')

<div class="container">
                
    <table class="table table-striped" id="tdatos">
        <thead>
            <tr>
                <th>1...</th>
                <th>2...</th>
                <th>3...</th>
                <th>4...</th>
                <th>5...</th>
                <th>6...</th>
                <th>7...</th>

            </tr>
        </thead>
        <tbody>      
            @foreach($tabladatos as $registro)
                <?php 
                    $datos = explode(',',rtrim($registro));                                                                
                ?>
                @if(((int)$datos[0])>0 && !empty($datos[2]))
                    <tr>
                        @foreach($datos as $dato)
                            @if($dato!="")
                                <td>{{ $dato }}</td>
                            @endif
                        @endforeach
                    </tr>
                @endif                                
            @endforeach
        </tbody>
    </table>


</div>

@endsection

@section('scripts')


{{ Html::script('/public/assets/vendor/datatables/media/js/jquery.dataTables.min.js') }}
{{ Html::script('/public/assets/vendor/datatables/media/js/dataTables.bootstrap.min.js') }}

<script type="text/javascript">

    $(document).ready(function() {
        
        $('#tdatos').DataTable({
            "scrollY": 480,
            "scrollCollapse": true,
            "paging": false,
            "info": false,
            "language": {
                "search": "Buscar:",
                "zeroRecords": "No se encontraron registros que coincidan",
            },
            "select": true,
            "emptyTable" : "No hay datos para mostrar"
        });

    });    
</script>

@endsection