@extends('layouts.app3')
@section('title','Administrador')
@section('menu')
<li>
	<a href="{{ route('usuarios.index') }}">Usuarios</a>
</li>
<li>
	<a href="{{ route('departamentos.index') }}">Departamentos</a>
</li>
<li>
	<a href="{{ route('actividades.index') }}">Actvidades</a>
</li>
<li>
	<a href="{{ route('lugares.index') }}">Lugares</a>
</li>
@endsection
@section('table id','table-md')
@section('header')
<tr>
	<th width="10px">#</th>
	<th>Departamento</th>
	<th>Municipio</th>
	<th>Dirección</th>
	<th width="80px">Modificar</th>
	<th width="80px">Eliminar</th>
</tr>
@endsection
@section('content')
<?php $counter = 0; ?>
@foreach($places as $place)
<?php
	$counter = $counter +1;
?>
<tr>
	<td>{{ $counter }}</td>
	<td>{{ $place->domain }}</td>
	<td>{{ $place->municipality }}</td>
	<td>{{ $place->address }}</td>
	<td>
		<a class="btn-edit btn btn-success" href="{{ route('lugares.edit',$place->id) }}"></a>
	</td>
	@if($place->users()->exists())
	<td class="action-denied"></td>
	@else
	<td>
		<form method="post" action="{{ action('PlaceController@destroy',$place->id) }}">
			@csrf
			@method('DELETE')
			<button type="submit" class="btn-delete btn btn-danger"></button>
		</form>
	</td>
	@endif
</tr>
@endforeach
@endsection
@section('paginar')
{{ $places->appends(['search'=>$search])->links() }}
@endsection
@section('btn add')
<a class="btn-agregar btn btn-normal" href="{{ route('lugares.create') }}">Agregar</a>
@endsection