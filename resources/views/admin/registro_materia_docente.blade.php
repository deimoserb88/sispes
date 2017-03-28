@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Registrar asignación de Materias a Docentes</div>
                <div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/savematdoc') }}">
					 {{ csrf_field() }}
						<div class="form-group">
							<div class="col-md-12">
                                <div class="input-group">
                            		<textarea id="datos" name="datos" class="form-control" rows="20" cols="80">
                            			
                            		</textarea>    	
                                </div>
                            </div>
						</div>
						<button type="submit" class="btn btn-success">Guardar</button>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
	<script>
	  function handleFileSelect(evt) {
	    evt.stopPropagation();
	    evt.preventDefault();

	    var files = evt.dataTransfer.files; // FileList object.
	    var reader = new FileReader();  
	    reader.onload = function(event) {            
	         document.getElementById('datos').value = event.target.result;
	    }        
	    reader.readAsText(files[0],"ISO-8859-1");
	  }

	  function handleDragOver(evt) {
	    evt.stopPropagation();
	    evt.preventDefault();
	    evt.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
	  }

	  // Setup the dnd listeners.
	  var dropZone = document.getElementById('datos');
	  dropZone.addEventListener('dragover', handleDragOver, false);
	  dropZone.addEventListener('drop', handleFileSelect, false);
	</script>
@endsection