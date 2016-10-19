@extends('layouts.main')

@section('content')
<div class="container" style="margin-top: 30px;">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                <div class="panel panel-default">
                    <div class="panel-heading">INICIO DE SESIÓN</div>
                    <div class="panel-body">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('login') ? ' has-error' : '' }}">

                                <div class="col-md-8 col-md-offset-2">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-btn fa-user"></i></span>
                                    <input id="login" type="text" class="form-control" name="login" value="{{ old('login') }}" placeholder="Número de trabajador" required="required">
                                </div>
                                    @if ($errors->has('login'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('login') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">                            

                                <div class="col-md-8 col-md-offset-2">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-btn fa-key"></i></span>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" required="required">
                                </div>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                    </div>
                    <div class="panel-footer">
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <button type="submit" class="btn btn-success btn-block">
                                        Iniciar <i class="fa fa-btn fa-sign-in"></i> 
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
