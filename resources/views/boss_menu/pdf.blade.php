<head>
	<title>Reporte</title>
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<h1 style="padding-bottom: 10px; text-align: center; font-size: 25px">Tareas verificadas por departamento</h1>
<h2 style="padding-bottom: 30px; text-align: center; font-size: 18px">{{ $date1 .' a '. $date2 }}</h2>
@foreach($Data as $department)
<div style="padding-bottom: 20px;page-break-after: auto;">
	<h4 style="text-align: center; font-size: 16px">{{ $department->name }}</h4>
	<table class="table table-striped" style="font-size: 10px;">
		<tr>
			<th>Código</th>
			<th>Técnico encargado</th>
			<th>Cliente</th>
			<th>Teléfono del cliente</th>
			<th>E-mail del cliente</th>
			<th>Asunto</th>
		</tr>
		@foreach($tasks as $task)
		@if($task->client->department->name == $department->name)
		<tr>
			<td>{{ $task->code }}</td>
			<td>{{ $task->technician->name }}</td>
			<td>{{ $task->client->name }}</td>
			<td>{{ $task->client->phone }}</td>
			<td>{{ $task->client->email }}</td>
			<td>{{ $task->task_type->name }}</td>
		</tr>

		@endif
		@endforeach
		<tr style="font-size: 12px">
			<td>Total de tareas: {{ $department->value }}</td>
		</tr>
	</table>
</div>
@endforeach
