@extends('layouts.app4')
@section('return')
    @if(url()->previous() == route('usuarios.edit',$user->id) || url()->previous() == route('usuarios.show',$user->id) || url()->previous() == route('edit.profile',$user->id)|| url()->previous() == route('show.profile',$user->id))
    {{ route('home') }}
    @else
    {{ url()->previous() }}
    @endif
@endsection
@section('content')
<div class="form form-md">
    <label>Nombre:</label>
    <p  class="show-info text-center" >{{ $user->name }}</p>
    <label>Teléfono:</label>
    <p  class="show-info text-center" >{{ $user->phone }}</p>
    <label>Correo:</label>
    <p  class="show-info text-center" >{{ $user->email }}</p>
    <label>Departamento:</label>
    <p  class="show-info text-center" >{{ $user->department->name }}</p>
    <label>Lugar asignado:</label>
    <p  class="show-info text-center" >{{ $user->place->domain.' | '.$user->place->municipality.' | '.$user->place->address }}</p>
    <label>Rol:</label>
    <p  class="show-info text-center" >{{ $user->role->name }}</p>
    @if($user->role_id == 2)
    <label>Tipos de actividades asignadas:</label>
    <ul style="margin-left:20px;">
        @foreach($user->task_types()->get() as $task_type)
            <li>{{ $task_type->name }}</li>
        @endforeach
    </ul>
    @endif
    <div style="float: right">
        <a class="btn-edit btn btn-success" href=@yield('edit route')></a>
    </div>
</div>
@endsection