@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">

            <div class="panel panel-primary">
                <div class="panel-heading">Prueba de lectura del Web Service</div>
                <div class="panel-body">
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
                            @foreach($datos as $registros)
                                <?php 
                                    //$datos = explode(',',rtrim($registro));                                                                
                                ?>
                                
                                    <tr>
                                        @foreach($registros as $registro)
                                            
                                                <td>{{ $registro }}</td>
                                            
                                        @endforeach
                                    </tr>
                                
                            @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
        
    </div>
</div>
@endsection