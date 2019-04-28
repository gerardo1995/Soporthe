@extends('layouts.app4')
@section('title','Editar departamento')
@section('return')
{{ route('departamentos.index') }}
@endsection
@section('header','Editar departamento')
@section('content')
<form class="form form-sm" method="post" action="{{ action('DepartmentController@update',$department->id) }}">
    @csrf
    @method('PUT')
    <label>Nombre de departamento:</label>
    <input type="text" name="name" class="form-input" value="{{ $department->name }}">
    @if($errors->has('name'))
    <div class="alert alert-danger">
        <span>{{ $errors->first('name') }}</span>
    </div>
    @endif
    <button type="submit" class="btn-agregar btn btn-normal">Modificar</button>
</form>
@endsection