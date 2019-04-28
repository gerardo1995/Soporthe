<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('css/PlantillaEditar.css') }}" rel="stylesheet">
		<title>@yield('title')</title>
	</head>
	<body>
		<div class="row"  style="width:101%;background-color: transparent;">
			<div class="col" style="width: 20%"><a href="@yield('return')" class="btn btn-normal back-link">&laquo; Regresar</a></div>
			<div class="col" style="width: 1110px; float: center;">
				<h1>@yield('header')</h1>
			</div>
			<div class="col" style="width: 20%;">
				<div  id="dropdown">
					<a href="#" class="drop-link" >{{ Auth::User()->name }} &#9660</a>
					<div id="dropdown-content">
						<a href="{{ route('show.profile',Auth::id()) }}">Mi perfil</a>
						<a style="border-top: 1px solid #d3d3d3" href="{{ url('/logout') }}">Cerrar sesión</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style=" min-height: 600px;">
			<div class="container" style="height: 100%">
				<div class="main">
					@yield('content')
				</div>
			</div>
		</div>
		<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
	</body>
</html>