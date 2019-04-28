@extends('layouts.app4')
@section('title','Agregar usuario')
@section('return')
{{ route('actividades.index') }}
@endsection
@section('header','Agregar actividad')
@section('content')
<form class="form form-sm" method="post" action="{{ route('actividades.store') }}">
    @csrf
    <label>Nombre:</label>
    <input type="text" name="name" class="form-input">
    @if($errors->has('name'))
    <div class="alert alert-danger">
        <span>{{ $errors->first('name') }}</span>
    </div>
    @endif
    <button type="submit" class="btn-agregar btn btn-normal">Crear</button>
</form>
@endsection