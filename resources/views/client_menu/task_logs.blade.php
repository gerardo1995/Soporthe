@extends('layouts.app3')
@section('title','Cliente')
@section('menu')
<li>
	<a href="{{ route('tasks.index') }}">Solicitudes</a>
</li>
<li>
	<a href="{{ route('task_logs.index') }}">Historial</a>
</li>
<style type="text/css">
	table{
		font-size: 14px
	}
</style>
@endsection
@section('table id','table-sm')
@section('header')
<tr>
	<th>Historial de solicitudes</th>
	<th width="80px">Borrar</th>
</tr>
@endsection
@section('content')

@foreach($task_logs as $task_log)
@if(Auth::id()==$task_log->task->client_id)
<tr>
	@if(Auth::id()==$task_log->user_id)
		@if($task_log->task_state_id===1) {{-- segundo ifpara saber si la accion fue crear o verificar --}}
		<td>
			@if($task_log->task->deleted_at===null)
			Has creado la solicitud {{ $task_log->task->code }}<br> Fecha: {{ $task_log->created_at }}
			@else
			Has creado la solicitud {{ '<solicitud eliminada>' }} Fecha: {{ $task_log->created_at }}
			@endif
		</td>
		@else
		<td>
			@if($task_log->task->deleted_at===null)
			Verificaste que la solicitud {{ $task_log->task->code }}<br> ha sido finalizada Fecha: {{ $task_log->created_at }}
			@else
			Verificaste que la solicitud {{ '<solicitud eliminada>' }} ha sido finalizada Fecha: {{ $task_log->created_at }}
			@endif
		</td>
		@endif
	@else
	<td>
		@if($task_log->task->deleted_at===null && $task_log->user->deleted_at===null && $task_log->user->role_id==2)
		{{ $task_log->user->name }} cambió el estado de la solicitud {{ $task_log->task->code }}<br> a {{ $task_log->task_state->name }} Fecha: {{ $task_log->created_at }}
		@else
			@if($task_log->task->deleted_at!=null && $task_log->user->role_id==2 && $task_log->user->deleted_at===null)
			{{ $task_log->user->name }} cambió el estado de la solicitud {{ '<solicitud eliminada>' }} a {{ $task_log->task_state->name }} Fecha: {{ $task_log->created_at }}
			@elseif($task_log->task->deleted_at===null && ($task_log->user->deleted_at!=null || $task_log->user->role_id!=2))
			{{ '<cuenta eliminada>' }} cambió el estado de la solicitud {{ $task_log->task->code }}<br> a {{ $task_log->task_state->name }} Fecha: {{ $task_log->created_at }}
			@else
			{{ '<cuenta eliminada>' }} cambió el estado de la solicitud {{ '<solicitud eliminada>' }} a {{ $task_log->task_state->name }} Fecha: {{ $task_log->created_at }}
			@endif
		@endif
	</td>
	@endif
	<td>
		<form method="post" action="{{ route('task_logs.destroy',$task_log->id) }}">
			@csrf
			@method('DELETE')
			<button type="submit" class="btn-delete btn btn-danger"></button>
		</form>
	</td>
</tr>
@endif
@endforeach
@section('paginar')
{{ $task_logs->appends(['search'=>$search])->links() }}
@endsection
@endsection