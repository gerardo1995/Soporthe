@if($task->task_state_id == 1)
@extends('layouts.app4')
@section('title','Editar descripción')
@section('return')
{{ route('show task annotation',$task->id) }}
@endsection
@section('header')
<p>Editar descripción de la solicitud<br>{{ $task->id }}</p>
@endsection
@section('content')
<form class="form form-lg" action="{{ route('update.description',['task'=>$task]) }}" method="POST">
	{{ method_field('PATCH') }}
	{{ csrf_field() }}
	<textarea maxlength="8500" name="description" class="form-input" style="height: 500px; width: 100%">{{ $task->description }}
	</textarea>
	@if($errors->has('description'))
	<div class="alert alert-danger">
		<span>{{ $errors->first('description') }}</span>
	</div>
	@endif
		<button class="btn-agregar btn btn-normal" type="submit">Modificar</button>
</form>

@endsection
@else
<div>Acceso denegado</div>
@endif