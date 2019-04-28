<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        <!-- Bootstrap core CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="{{ asset('css/simple-sidebar.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/menu_empleado_tabla.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/menu_empleado.css') }}">
    </head>
    <body>
        <div id="wrapper" class="row">
            <div class="col">
                <div id="sidebar-wrapper">
                    <ul class="sidebar-nav">
                        <li class="sidebar-brand">
                            <h1>{{ config('app.name', 'Laravel') }}</h1>
                        </li>
                        @yield('menu')
                        <br>
                        <li><a href="{{ url('/logout') }}">Cerrar Sesión</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-12">
                <div id="page-content-wrapper" >
                    <a href="#menu-toggle" class="btn btn-normal" id="menu-toggle">&#9776;</a>
                    <div class="dropdown">
                        <a class="drop-link" >{{ Auth::User()->name }} &#9660</a>
                        <div class="dropdown-content">
                            <a href="{{ route('show.profile',Auth::id()) }}">Mi perfil</a>
                            <a style="border-top: 1px solid #d3d3d3" href="{{ url('/logout') }}">Cerrar sesión</a>
                        </div>
                    </div>
                    <div id="@yield('table id')">
                        <div style="position: relative; right: 0">
                            <form method="get">
                                <input type="text" id="search" name="search" value="{{ isset($search) ? $search : ''}}" placeholder="Buscar...">
                                <input type="submit" style="display: none" />
                            </form>
                        </div>
                        <div class="table-responsive" >
                            <table style="margin-bottom: 20px">
                                <thead>
                                    @yield('header')
                                </thead>
                                <tbody id="table">
                                    @yield('content')
                                </tbody>
                            </table>
                        </div>
                        <div  class="row">
                            <div class="col">
                                @yield('paginar')
                            </div>
                            <div class="col">
                                @yield('btn add')
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script>
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        </script>
    </body>
</html>