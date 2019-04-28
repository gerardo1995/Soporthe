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
	<th>Actvidad</th>
	<th width="80px">Modificar</th>
	<th width="80px">Eliminar</th>
</tr>
@endsection
@section('content')
<?php $counter = 0; ?>
@foreach($task_types as $task_type)
<?php
	$counter = $counter +1;
?>
<tr>
	<td>{{ $counter }}</td>
	<td>{{ $task_type->name }}</td>
	<td>
		<a class="btn-edit btn btn-success" href="{{ route('actividades.edit',$task_type->id) }}"></a>
	</td>
	@if($task_type->users()->exists() || $task_type->tasks()->exists())
	<td class="action-denied"></td>
	@else
	<td>
		<form method="post" action="{{ action('TaskTypeController@destroy',$task_type->id) }}">
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
{{ $task_types->appends(['search'=>$search])->links() }}
@endsection
@section('btn add')
<a class="btn-agregar btn btn-normal" href="{{ route('actividades.create') }}">Agregar</a>
@endsection