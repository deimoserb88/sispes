@extends('layouts.admin')

@section('estilos')
    {{ Html::style('/public/assets/vendor/datatables/media/css/dataTables.bootstrap.min.css') }}
@endsection

@section('content')
<div class="container">

	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-4">
					<h4>Lista de asignaturas registradas</h4>
				</div>
				<div class="col-md-8">
					<div class="input-group">
  						<span class="input-group-addon" id="basic-addon1">Programa</span>  						
						<select class="form-control" name="plan" id="plan">
							<option value="">Todos</option>
							@foreach($p as $plan=>$prog)
								<option value="{{ $plan }}" {{ $plan == $pln ? 'selected="selected"' : '' }}>{{ $prog }}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-body">		
 			<table class="table table-striped" id="tasignaturas">
				<thead>
					<tr>
						<th>Plan</th>
						<th>Asignatura</th>
						<th>Sem.</th>
						<th>Gpo.</th>
						<th><i class="fa fa-cog" aria-hidden="true"></i></th>
					</tr>				
				</thead>
				<tbody>
					@foreach($a as $asigna)
						<tr>
							<td><span data-toggle="tooltip" data-placement="right" title="{{ $p[$asigna->plan] }}">{{ $asigna->plan }}</span></td>
							<td>{{ $asigna->asignatura }}</td>
							<td>{{ $asigna->sem }}o</td>
							<td>{{ $asigna->gpo }}</td>
							<td>
								<div class="btn-group btn-group-xs" role="group" aria-label="...">
								  <button type="button" class="btn btn-info">
								  	<i class="fa fa-caret-right" aria-hidden="true"></i>
								  	<i class="fa fa-user" aria-hidden="true"></i>
								  </button>
								  <button type="button" class="btn btn-danger">
								  	<i class="fa fa-trash-o" aria-hidden="true"></i>
								  </button>								  
								</div>								
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>


	
</div>
@endsection

@section('scripts')

{{ Html::script('/public/assets/vendor/datatables/media/js/jquery.dataTables.min.js') }}
{{ Html::script('/public/assets/vendor/datatables/media/js/dataTables.bootstrap.min.js') }}

<script type="text/javascript">	
    $(document).ready(function() {     
        
    	$('[data-toggle="tooltip"]').tooltip()

    	$('#plan').change(function(){
    		var destino = '';
    		destino = '/listaasig/'+$(this).val();
    		window.location.href = destino;
    	});

        $('#tasignaturas').DataTable({
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
                { "orderable": false, "targets": 4 }
            ],             
        });

    }); 	
</script>
@endsection