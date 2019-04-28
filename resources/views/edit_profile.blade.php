@extends('layouts.app4')
@section('title','Editar perfil')
@section('return')
{{ route('show.profile',$user->id) }}
@endsection
@section('header','Editar perfil')
@section('content')
<form class="form form-md" method="post" action="{{ route('update.profile',$user->id) }}">
    @csrf
    @method('PUT')
    <label>Nombre:</label>
    <input type="text" name="name" class="form-input" value="{{ $user->name }}">
    @if($errors->has('name'))
    <div class="alert alert-danger">
        <span>{{ $errors->first('name') }}</span>
    </div>
    @endif
    <label>Teléfono:</label>
    <input type="text" name="phone" class="form-input" value="{{ $user->phone }}">
    @if($errors->has('phone'))
    <div class="alert alert-danger">
        <span>{{ $errors->first('phone') }}</span>
    </div>
    @endif
    <label>Correo:</label>
    <input type="email" name="email" class="form-input" value="{{ $user->email }}">
    @if($errors->has('email'))
    <div class="alert alert-danger">
        <span>{{ $errors->first('email') }}</span>
    </div>
    @endif
    <button class="btn-agregar btn btn-normal" type="submit">Modificar</button>
</form>
@endsection