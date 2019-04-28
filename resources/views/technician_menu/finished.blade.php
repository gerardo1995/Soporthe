@extends('layouts.app2')
@section('title')
Tareas finalizadas
@endsection
@section('task bar')
<li><a href="{{ route('pending') }}">Tareas pendientes</a></li>
<li><a href="{{ route('initiated') }}">Tareas iniciadas</a></li>
<li class="active"><a href="{{ route('finished') }}">Tareas finalizadas</a></li>
@endsection
@section('records')
<?php $counter = 0; ?>
@foreach($tasks as $task)
@if(
($task->task_state_id===3
|| $task->task_state_id===4)
&& $task->deleted_at === null
&& $task->client->deleted_at===null
&& $task->client->role_id===3
)
@section('extra fields')
<th>Estado</th>
<th>Anotación</th>
<th width="50px">Chat</th>
<th width="80px">Mover a iniciadas</th>
@endsection
<tr>
	<?php
		$counter = $counter +1;
	?>
	<td>{{ $counter }}</td>
	<td>{{ $task->code }}</td>
	<td>{{ $task->client->name }}</td>
	<td>{{ $task->client->email }}</td>
	<td>{{ $task->task_type->name }}</td>
	<td><a href="{{ route('show.description',$task->id) }}">mostrar</a></td>
	<td>{{ $task->client->place->domain }}</td>
	<td>{{ $task->client->place->municipality }}</td>
	<td>{{ $task->client->place->address }}</td>
	<td>{{ $task->created_at }}</td>
	@if($task->task_state_id== 4)
	<td>Verificada</td>
	@else
	<td>Por verificar</td>
	@endif
	<td><a href="{{ route('show task annotation',['task'=>$task]) }}">mostrar</a></td>
	<td><a class="btn-chat btn btn-success" href="{{ route('chat.index',$task->id) }}"></a></td>
	@if($task->task_state_id==3)
	<td>
		<form action="{{ route('update task state',['task'=>$task]) }}" method="POST" id="form {{ $task->id }}">
			{{ method_field('PATCH') }}
			{{ csrf_field() }}
			<input type="hidden" name="task_state_id" value="2">
			<a class="btn-left btn btn-success" href="javascript:{}" style="font-size: 20px; height: 50px; width: 50px;" onclick="document.getElementById('form {{ $task->id }}').submit(); return false;"></a>
		</form>
	</td>
	@else
	<td class="action-denied"></td>
	@endif
</tr>
@endif
@endforeach
@endsection