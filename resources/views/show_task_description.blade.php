@extends('layouts.app4')
@section('title','Mostrar descripción')
@section('return')
@if(Auth::user()->role_id == 2)
{{ url()->previous() }}
@else
{{ route('tasks.index') }}
@endif
@endsection
@if(Auth::user()->role_id==2)
@section('header')
<p>Descripción de la tarea<br>{{ $task->code }}</p>
@endsection
@else
@section('header')
<p>Descripción de la solicitud<br>{{ $task->code }}</p>
@endsection
@endif
@section('content')
<div class="form form-lg">
    <textarea class="show-info" readonly style="height: 500px; width: 100%">{{ $task->description }}</textarea>
    @if(Auth::user()->role_id == 3 && $task->task_state_id == 1)
    <div style="float: right">
        <a class="btn-edit btn btn-success" href="{{ route('edit.description',$task->id) }}"></a>
    </div>
    @endif
</div>
@endsection