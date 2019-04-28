@extends('layouts.app4')
@section('title','Agregar usuario')
@section('return')
{{ route('departamentos.index') }}
@endsection
@section('header','Agregar departamento')
@section('content')
<form class="form form-sm" method="post" action="{{ route('departamentos.store') }}">
    @csrf
    <label>Nombre de departamento:</label>
    <input type="text" name="name" class="form-input">
     @if($errors->has('name'))
    <div class="alert alert-danger">
        <span>{{ $errors->first('name') }}</span>
    </div>
    @endif
    <button type="submit" class="btn-agregar btn btn-normal">Crear</button>
</form>
@endsection