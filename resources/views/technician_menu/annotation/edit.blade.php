@if($task->task_state_id != 4)
@extends('layouts.app4')
@section('title','Editar anotaciones')
@section('return')
{{ route('show task annotation',$task->id) }}
@endsection
@section('header')
<p>Editar anotaciones de la tarea<br>{{ $task->code }}</p>
@endsection
@section('content')
<form class="form form-lg" action="{{ route('update task annotation',['task'=>$task]) }}" method="POST">
	{{ method_field('PATCH') }}
	{{ csrf_field() }}
	<textarea maxlength="9000" name="annotation" class="form-input" style="height: 500px; width: 100%">{{ $task->annotation }}</textarea>
	<button class="btn-agregar btn btn-normal" type="submit">Modificar</button>
</form>
@endsection
@else
<div>Acceso denegado</div>
@endif