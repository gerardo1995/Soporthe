@extends('layouts.app4')
@section('title','Editar usuario')
@section('return')
@if(url()->previous() == route('usuarios.edit',$user->id) || url()->previous() == route('show.profile',Auth::id()))
{{ route('home') }}
@else
{{ url()->previous() }}
@endif
@endsection
@section('header','Editar usuario')
@section('content')
<form class="form form-md" method="post" action="{{ route('usuarios.update',$user->id) }}">
    @csrf
    @method('PUT')
    <div style="width: 100%;">
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
        <label>Lugar:</label>
        <select name="place_id">
            @foreach($places as $place)
            @if($user->place_id == $place->id)
            <option selected="selected" value="{{ $place->id }}" >{{ $place->domain.' | '.$place->municipality.' | '.$place->address }}</option>
            @else
            <option value="{{ $place->id }}" >{{ $place->domain.' | '.$place->municipality.' | '.$place->address }}</option>
            @endif
            @endforeach
        </select>
        @if($errors->has('place_id'))
        <div class="alert alert-danger">
            <span>{{ $errors->first('place_id') }}</span>
        </div>
        @endif
        <label>Rol:</label>
        <select id="roles" name="role_id" onchange="showHide(this)">
            @foreach($roles as $role)
            @if($user->role_id == $role->id)
            <option selected="selected" value="{{ $role->id }}" >{{ $role->name }}</option>
            @else
            <option value="{{ $role->id }}" >{{ $role->name }}</option>
            @endif
            @endforeach
        </select>
        @if($errors->has('role_id'))
        <div class="alert alert-danger">
            <span>{{ $errors->first('role_id') }}</span>
        </div>
        @endif
        <label>Departamento:</label>
        <select name="department_id" style="margin-bottom: 30px">
            @foreach($departments as $department)
            @if($user->department_id == $department->id)
            <option selected="selected" value="{{ $department->id }}">{{ $department->name }}</option>
            @else
            <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endif
            @endforeach
        </select>
        @if($errors->has('department_id'))
        <div class="alert alert-danger">
            <span>{{ $errors->first('department_id') }}</span>
        </div>
        @endif
        @if($user->role_id==2)
        <div id="task-types-div" style="display: block;">
        @else
        <div id="task-types-div" style="display: none;">
        @endif
            <label>Tipos de actividades (solo para técnicos):</label>
            <table  style="margin-left: 20px">
                @foreach($task_types as $task_type)
                <tr>
                    <td>
                        @if($user->task_types()->where('task_type_id',$task_type->id)->exists())
                        <input type="checkbox" name="task_types[]" class="tp" value="{{ $task_type->id }}" checked>
                        @else
                        <input type="checkbox" name="task_types[]" class="tp" value="{{ $task_type->id }}">
                        @endif
                    </td>
                    <td>{{ $task_type->name }}</td>
                </tr>
                @endforeach
            </table>
                @if($errors->has('task_types[]'))
                <div class="alert alert-danger">
                    <span>{{ $errors->first('task_types[]') }}</span>
                </div>
                @endif
            </div>
        </div>
        <button class="btn-agregar btn btn-normal" type="submit" >Modificar</button>
    </form>
    <script>
    function showHide(elem) {
    if(elem.value == 2) {
    document.getElementById('task-types-div').style.display = 'block';
    }else{
    document.getElementById('task-types-div').style.display = 'none';
    }
    }
    </script>
    @endsection