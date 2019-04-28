@extends('layouts.app4')
@section('title','Mostrar anotaciones')
@section('header')
<p>Anotaciones de la tarea<br>{{ $task->code }}</p>
@endsection
@section('return')
@if($task->task_state_id == 1)
{{ route('pending') }}
@elseif($task->task_state_id == 2)
{{ route('initiated') }}
@else
{{ route('finished') }}
@endif
@endsection
@section('content')
<div class="form form-lg">
	<textarea readonly class="show-info" style="height: 500px;  width: 100%">{{ $task->annotation }}</textarea>
	@if($task->task_state_id != 4)
	<div style="float: right">
		<a class="btn-edit btn btn-success" href="{{ route('edit task annotation',$task->id) }}"></a>
	</div>
	@endif
</div>
@endsection