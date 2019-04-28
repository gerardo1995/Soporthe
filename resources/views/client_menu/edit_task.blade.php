@extends('layouts.app4')
@section('title','Editar solicitud')
@section('return')
{{ route('tasks.index') }}
@endsection
@section('header')
<p>Editar solicitud<br>{{ $task->code }}</p>
@endsection
@section('content')
<form class="form form-lg" style="width: 100%" method="post" action="{{ route('tasks.update',$task->id) }}">
    @csrf
    @method('PUT')
    @if($errors->has('technician_id') && !($errors->has('description')))
    <div class="alert alert-danger">
        <span>{{ $errors->first('technician_id') }}</span>
    </div>
    @endif
    <label>Tipo de solicitud:</label>
    <select name="task_type_id">
        @foreach($task_types as $task_type)
        <option value="{{ $task_type->id }}" >{{ $task_type->name }}</option>
        @endforeach
    </select>
    <label>Descripción:</label>
    <textarea maxlength="8500" name="description" class="form-input" style="height: 400px;">{{ $task->description }}</textarea>
    @if($errors->has('description'))
    <div class="alert alert-danger">
        <span>{{ $errors->first('description') }}</span>
    </div>
    @endif
    <button type="submit" class="btn-agregar btn btn-normal" >Modificar</button>
</form>
@endsection