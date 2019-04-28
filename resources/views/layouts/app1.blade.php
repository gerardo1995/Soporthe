<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="author" content="">
        <title>@yield('title')</title>
        <!-- Bootstrap core CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/menu_empleado.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/menu_empleado_tabla.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/side-bar-horizontal.css') }}">
        <style>
        @import url('https://fonts.googleapis.com/css?family=Pacifico');
        </style>
    </head>
    <body>
        <div id="me">
            <div class="row" id="me-seccion-1">
                <div class="col" style="float: left">
                    <br>
                    <h1 id="me-titulo" >{{ config('app.name', 'Laravel') }}</h1>
                </div>
                <div class="col" style="position: absolute;right: 0; top: 0;">
                    <div class="dropdown">
                        <a href="#" class="drop-link">{{ Auth::User()->name }} ▼</a>
                        <div class="dropdown-content">
                            <a href="{{ route('show.profile',Auth::id()) }}">Mi perfil</a>
                            <a style="border-top: 1px solid #d3d3d3" href="{{ url('/logout') }}">Cerrar sesión</a>
                        </div>
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
    </body>
</html>