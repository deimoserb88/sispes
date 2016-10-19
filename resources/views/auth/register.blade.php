@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                <div class="panel panel-default">
                    <div class="panel-heading">Registro de usuario</div>
                    <div class="panel-body">
                            {{ csrf_field() }}

                            <div class="form-group">                            

                                <div class="col-md-8 col-md-offset-2">
                                    <select id="rol" class="form-control rol" name="rol">
                                        <option value="" selected="selected" disabled="disabled">Tipo de usuario</option>
                                        <option value="2" {{ old('rol')=='2'?'selected="selected"':'' }}>Docente</option>
                                        <option value="1" {{ old('rol')=='1'?'selected="selected"':'' }}>Administrador de plantel</option>
                                        <option value="1,2" {{ old('rol')=='1,2'?'selected="selected"':'' }}>Administrador y docente</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('plantD') ? ' has-error' : '' }} plantD">                            

                                <div class="col-md-8 col-md-offset-2">
                                    <input id="plantD" type="text" class="form-control" name="plantD" value="{{ old('plantD') }}" placeholder="Planteles donde imparte clase, separados por coma" >

                                    @if ($errors->has('plantD'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('plantD') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('plantA') ? ' has-error' : '' }}  plantA">                            

                                <div class="col-md-8 col-md-offset-2">
                                    <input id="plantA" type="text" class="form-control" name="plantA" value="{{ old('plantA') }}" placeholder="Plantel que administra" >

                                    @if ($errors->has('plantA'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('plantA') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>
                            <hr>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">                            

                                <div class="col-md-8 col-md-offset-2">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nombre comleto">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('login') ? ' has-error' : '' }}">                            

                                <div class="col-md-8 col-md-offset-2">
                                    <input id="login" type="text" class="form-control" name="login" value="{{ old('login') }}" placeholder="Número de trabajador">

                                    @if ($errors->has('login'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('login') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">                            

                                <div class="col-md-8 col-md-offset-2">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo electrónico">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">                            

                                <div class="col-md-8 col-md-offset-2">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                

                                <div class="col-md-8 col-md-offset-2">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar contraseña">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                    </div>
                    <div class="panel-footer">
                            <div class="form-group" style="margin-bottom: 0">
                                <div class="col-md-8 col-md-offset-2 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary btn-block btn-success">
                                        Guardar registro <i class="fa fa-btn fa-user"></i>
                                    </button>
                                </div>
                            </div>                    
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $(".plantD").hide();
            $(".plantA").hide();
            $(".rol").change(function(){        
                var muestraD = $(".rol").val() === "2" || $(".rol").val() === "1,2";
                var muestraA = $(".rol").val() === "1" || $(".rol").val() === "1,2";
                
                if(muestraD){
                    $(".plantD").show("fast");
                }else{
                    $("#plantD").val("");
                    $(".plantD").hide("fast");
                }

                if(muestraA){
                    $(".plantA").show("fast");
                }else{
                    $("#plantA").val("");
                    $(".plantA").hide("fast");                
                }
            });
        });
    </script>
@endsection
