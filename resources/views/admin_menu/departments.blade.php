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
@section('table id','table-sm')
@section('header')
<tr>
	<th width="10px">#</th>
	<th>Nombre</th>
	<th width="80px">Modificar</th>
	<th width="80px">Eliminar</th>
</tr>
@endsection
@section('content')
<?php $counter = 0; ?>
@foreach($departments as $department)
<?php
	$counter = $counter +1;
?>
<tr>
	<td>{{ $counter }}</td>
	<td>{{ $department->name }}</td>
	<td width="100px">
		<a class="btn-edit btn btn-success"href="{{ route('departamentos.edit',$department->id) }}"></a>
	</td>
	@if($department->users()->exists())
	<td class="action-denied"></td>
	@else
	<td>
		<form method="post" action="{{ action('DepartmentController@destroy',$department->id) }}">
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
{{ $departments->appends(['search'=>$search])->links() }}
@endsection
@section('btn add')
<a class="btn-agregar btn btn-normal" href="{{ route('departamentos.create') }}">Agregar</a>
@endsection