@extends('layouts.admin')

@section('content')
<div class="container">

	<div class="panel panel-primary">
		<div class="panel-heading">
			Lista de gurpos registrados
		</div>
		<div class="panel-body">		
{{-- 			<table class="table table-striped" id="tgrupos">
				<thead>
					
				</thead>
			</table>
 --}}		</div>
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