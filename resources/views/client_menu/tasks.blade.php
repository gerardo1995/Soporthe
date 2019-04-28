@extends('layouts.app3')
@section('title','Cliente')
@section('menu')
<li>
	<a href="{{ route('tasks.index') }}">Solicitudes</a>
</li>
<li>
	<a href="{{ route('task_logs.index') }}">Historial</a>
</li>
@endsection
<style type="text/css">
	table{
		font-size: 14px
	}
</style>
@section('table id','table-lg')
@section('header')
<tr>
	<th width="10px">#</th>
	<th style="min-width: 150px;">Código</th>
	<th>Técnico encargado</th>
	<th>Teléfono</th>
	<th>E-mail</th>
	<th>Asunto</th>
	<th>Descripción</th>
	<th style="min-width: 80px">Fecha de creación</th>
	<th>Estado</th>
	<th width="50px">Chat</th>
	<th width="80px">Verificar</th>
	<th width="80px">Modificar</th>
	<th width="80px">Eliminar</th>
</tr>
@endsection
@section('content')
<?php $counter = 0; ?>
@foreach($tasks as $task)
@if(Auth::id()==$task->client_id)
<?php
	$counter = $counter + 1;
?>
<tr>
	<td>{{ $counter }}</td>
	<td>{{ $task->code }}</td>
	<td>
		@if($task->technician->deleted_at===null && $task->technician->role_id==2)
		{{ $task->technician->name }}
		@else
		{{ '<cuenta eliminada>' }}
		@endif
	</td>
	<td>
		@if($task->technician->deleted_at===null && $task->technician->role_id==2)
		{{ $task->technician->phone }}
		@else
		{{ '<cuenta eliminada>' }}
		@endif
	</td>
	<td>
		@if($task->technician->deleted_at===null && $task->technician->role_id==2)
		{{ $task->technician->email }}
		@else
		{{ '<cuenta eliminada>' }}
		@endif
	</td>
	<td>{{ $task->task_type->name }}</td>
	<td><a href="{{ route('show.description',$task->id) }}">mostrar</a></td>
	<td>{{ $task->created_at }}</td>
	<td>{{ $task->task_state->name }}</td>
	<td><a class="btn-chat btn btn-success" href="{{ route('chat.index',$task->id) }}"></a></td>
	@if($task->task_state_id==3)
	<td>
		<form style="margin: 0" action="{{ route('verify.task',['task'=>$task]) }}" method="POST" id="form {{ $task->id }}">
			{{ method_field('PATCH') }}
			{{ csrf_field() }}
			<input type="hidden" name="task_state_id" value="4">
			<a class="btn-verify btn btn-success" href="javascript:{}" onclick="AlertaVerificar(document.getElementById('form {{ $task->id }}'))"></a>
		</form>
	</td>
	@else
	<td class="action-denied"></td>
	@endif
	@if($task->task_state_id == 1)
	<td><a class="btn-edit btn btn-success" href="{{ route('tasks.edit',$task->id) }}"></a></td>
	<td>
		<form style=" margin: 0px" action="{{ route('tasks.destroy',$task->id) }}" method="POST" id="form-delete {{ $task->id }}">
			@csrf
			@method('DELETE')
			<button form="form-delete {{ $task->id }}" type="submit" class="btn-delete btn btn-danger"></button>
		</form>
	</td>
	@elseif($task->task_state_id == 4 || $task->technician->deleted_at!=null)
	<td class="action-denied"></td>
	<td>
		<form style=" margin: 0px" method="POST" id="form-delete {{ $task->id }}" action="{{ route('tasks.destroy',$task->id) }}" >
			@csrf
			@method('DELETE')
			<button form="form-delete {{ $task->id }}" type="submit" class="btn-delete btn btn-danger"></button>
		</form>
	</td>
	@else
	<td class="action-denied"></td>
	<td class="action-denied"></td>
	@endif
</tr>
@endif
@endforeach
@endsection
@section('paginar')
{{ $tasks->appends(['search'=>$search])->links() }}
@endsection
@section('btn add')
<a class="btn-agregar btn btn-normal" href="{{ route('tasks.create') }}">Crear Solicitud</a>
@endsection
<script type="text/javascript">
function AlertaVerificar(form_id) {
	var answer = confirm ("Esta acción no se puede revertir. ¿Seguro que quiere verificar esta tarea?")
	if (answer)
	form_id.submit(); return false;
}
</script>