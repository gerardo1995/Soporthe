@extends('layouts/app5')
@section('title','Info. de usuario')
@section('header')
<p>Información de<br>{{ $user->name }}</p>
@endsection
@section('edit route',route('usuarios.edit',$user->id))