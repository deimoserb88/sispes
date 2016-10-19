@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="text-success">BIENVENIDO</h3></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6" style="height: 340px;">

                            <div id="carousel-portada" class="carousel slide" data-ride="carousel" style="box-shadow: 5px 5px 20px #BBB;">
                              <!-- Indicators -->
 {{--                              <ol class="carousel-indicators">
                                <li data-target="#carousel-portada" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-portada" data-slide-to="1"></li>
                                <li data-target="#carousel-portada" data-slide-to="2"></li>
                                <li data-target="#carousel-portada" data-slide-to="3"></li>
                              </ol> --}}

                              <!-- Wrapper for slides -->
                              <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                  {{-- {{ Html::image('/public/images/13.jpg','') }} --}}
                                  <img src="{{ URL::to('/') }}/public/images/2.jpg"  class="img-thumbnail" alt="">
                                  <div class="carousel-caption">
                                    
                                  </div>
                                </div>
                                <div class="item">
                                  <img src="{{ URL::to('/') }}/public/images/1B.jpg" class="img-thumbnail" alt="">
                                  <div class="carousel-caption">
                                    
                                  </div>
                                </div>
                                <div class="item">
                                  <img src="{{ URL::to('/') }}/public/images/3B.jpg" class="img-thumbnail" alt="">
                                  <div class="carousel-caption">
                                    
                                  </div>
                                </div>
                                <div class="item">
                                  <img src="{{ URL::to('/') }}/public/images/4.jpg" class="img-thumbnail" alt="">
                                  <div class="carousel-caption">
                                    
                                  </div>
                                </div>                               
                              </div>

                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <h3 class="text-primary text-center">Sistema para el Seguimiento de Prácticas en Educación Superior</h3>
                            <h4 class="text-center text-primary"><strong>Laboratorio - Taller - Campo</strong></h4>
                            <br>
                            @if (Auth::guest())
                              <br><br>
                              <button type="button" onclick="window.location.href='{{ url('/login') }}'" class="btn btn-primary btn-block">Iniciar sesión <i class="fa fa-btn fa-sign-in"></i></button>
                            @else

                            <div class="panel panel-primary">
                              <div class="panel-heading">Panel de actividades <i class="fa fa-btn fa-tasks"></i></div>
                              <div class="panel-body">
                                  Actividades...
                              </div>                              
                            </div>


                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('.carousel').carousel();
    });
</script>
@endsection