@extends('layouts.app4')
@section('title','Agregar usuario')
@section('return')
{{ route('lugares.index') }}
@endsection
@section('header','Agregar lugar')
@section('content')
<form class="form form-md" method="post" action="{{ route('lugares.store') }}">
    @csrf
    <label>Departamento:</label>
    <input type="text" name="domain" class="form-input">
    @if($errors->has('domain'))
    <div class="alert alert-danger">
        <span>{{ $errors->first('domain') }}</span>
    </div>
    @endif
    <label for="municipality">Municipio:</label>
    <input type="text" name="municipality" class="form-input">
    @if($errors->has('municipality'))
    <div class="alert alert-danger">
        <span>{{ $errors->first('municipality') }}</span>
    </div>
    @endif
    <label>Dirección:</label>
    <input type="text" name="address" class="form-input">
    @if($errors->has('address'))
    <div class="alert alert-danger">
        <span>{{ $errors->first('address') }}</span>
    </div>
    @endif
    <button type="submit" class="btn-agregar btn btn-normal">Crear</button>
</form>
@endsection