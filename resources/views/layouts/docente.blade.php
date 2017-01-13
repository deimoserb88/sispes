<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>[SISPES]</title>

    <link type="image/x-icon" href="http://www.ucol.mx/cms/img/favicon.ico" rel="icon" />
    {{--Estilos--}}
    {{ Html::style('https://fonts.googleapis.com/css?family=Lato:100,300,400,700') }}<!-- Fonts -->
    {{ Html::style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css') }}<!-- Iconos -->
    {{ Html::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') }}<!-- Bootstrap -->
    {{ Html::style('http://www.ucol.mx/cms/headerfooterapp.css') }}
    

    @yield('estilos') <!--Para agregar estilos propios de cada modulo-->

    {{-- JavaScripts --}}


    <style>
        body {
            font-family: 'Lato';
            position: relative;
        }
        .affix {
            top:0;
            width: 100%;
            z-index: 9999 !important;
        }
        .navbar {
            margin-bottom: 10px;
        }

        .affix ~ .container-fluid {
           position: relative;
           top: 50px;
        }
        .fa-btn {
            margin-left: 6px;
        }
    </style>
</head>
<body id="app-layout"  data-spy="scroll" data-target=".navbar" data-offset="50">
<div id="estructura">
        <header id="p-header" style="margin-bottom: 0;">
        <div id="p-top">
            <div class="p-encabezado">
                <div class="linkUcol">
                    <a class="escudo" href="http://www.ucol.mx/">&nbsp;</a>
                    <a class="nombre" href="http://www.ucol.mx/">&nbsp;</a>
                </div>
            <div class="TituloDep">Dirección General de Educación Superior</div>
                <ul class="hidden-mobile" id="menu-header">
                    <form action="http://www.ucol.mx/conocenos/buscar.htm" id="search-form" class="">
                        <div class="input-append pull-right">
                                <input type="hidden" value="008220538144971964399:mwxy_s7mt4u" name="cx">
                                <input type="hidden" value="FORID:10" name="cof">
                                <input type="hidden" value="UTF-8" name="ie">
                                <input id="q" class="search" name="q" type="text" placeholder="Buscar en ucol..." size="16">
                                <input name="more" class="botonbuscar" value="" type="submit">
                        </div>
                    </form>                    
                    <li><a href="http://www.ucol.mx/trabajadores/" target="_blank">Trabajadores</a></li>
                </ul>
            </div><!--encabezdo-->
        </div><!--top-->
    </header>
    <nav class="navbar navbar-default"  data-spy="affix" data-offset-top="84">
        <div class="container" style="width: 100%;">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    SISPES <i class="fa fa-btn fa-home"></i>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="#">Está trabajando en el ciclo <strong>{{ $cicloNombre->first()->desc }}</strong></a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    @yield('menu_items')
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Iniciar sesión<i class="fa fa-btn fa-sign-in"></i></a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ explode(" ",Auth::user()->name)[0] }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/docenteHome') }}">Panel de actividades <i class="fa fa-btn fa-tasks"></i></a></li>
                                @if(count(explode(",",Auth::user()->plantD))>1)
                                    <li><a href="{{ url('/cambiarPlantel/'.Auth::user()->plantD) }}">Cambiar de plantel <i class="fa fa-btn fa-random"></i></a></li>    
                                @endif
                                <li><a href="{{ url('/logout') }}">Cerrar sesión <i class="fa fa-btn fa-sign-out"></i></a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>


    @yield('content')


</div> <!--estructura-->
       <footer id="p-footer"><!-- footer -->
            <div class="inner">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 mapa">
                            <div class="address pull-right">
                                <ul>
                                    <li><i class="icon-address"></i><strong>Direcci&oacute;n:</strong> Av. Universidad No. 333, Las V&iacute;boras; CP 28040 Colima, Colima, M&eacute;xico</li>
                                   <!--<li><i class="icon-email"></i><a href="/portal-web/Directorio.htm">Directorio</a></li>
                                    <li><i class="icon-map"></i><a href="/conocenos/mapa.htm">Mapa del sitio</a></li>-->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="p-copyright">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6 col-xs-6 izquierda">
                                <a href="http://www.sep.gob.mx/" target="_blank"><img src="http://www.ucol.mx/cms/img/LogoSEP1.png"></a>
                                <a href="http://www.anuies.mx/" target="_blank"><img src="http://www.ucol.mx/cms/img/anuies.png"></a>
                                <a href="http://www.unesco.org/new/es/" target="_blank"><img src="http://www.ucol.mx/cms/img/unesco.png"></a>
                                <a href="http://www.cumex.org.mx/" target="_blank"><img src="http://www.ucol.mx/cms/img/consorcio.png"></a>
                            </div>
                            <div class="col-md-6 col-xs-6 derecha">
                                <a href="http://www.federaciondeestudiantescolimenses.com/"target="_blank"><img src="http://www.ucol.mx/cms/img/LogoFEC.png"  width="81px" height="30px" ></a>
                                &nbsp;<a href="#" target="_blank"><img src="http://www.ucol.mx/cms/img/SUTUC.png"></a>
                                &nbsp;<a href="http://portal.ucol.mx/feuc/"  target="_blank"><img src="http://www.ucol.mx/cms/img/LogoFEUC.png"></a>
                                <!-- &nbsp;<a href="http://www.fundacionucol.org/" target="_blank"><img src="/cms/img/fundacionUcol.png"></a> -->
                            </div>
                        </div>
                        <div class="col-md-12 derechos">&copy; Derechos Reservados 2013-2016 Universidad de Colima</div>
                    </div>
                </div>
            </div>
        </footer>
    <script src="http://www.ucol.mx/cms/js/jquery.mobilemenu.js"></script>
    <script src="http://www.ucol.mx/cms/js/jquery.liquidcarousel.js"></script>
    <script src="http://www.ucol.mx/cms/js/jquery.slides.js"></script>
    <script src="http://www.ucol.mx/cms/js/main.js"></script>
    <script src="http://www.ucol.mx/cms/js/custom.js"></script>

    {{ Html::script('public/assets/vendor/jquery/dist/jquery.min.js') }}
    {{ Html::script('public/assets/vendor/bootstrap/dist/js/bootstrap.min.js') }}

    

    @yield('scripts'){{--Para scripts JQuery propios del módulo--}}

</body>
</html>
