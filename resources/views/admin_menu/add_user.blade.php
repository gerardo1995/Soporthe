@extends('layouts.app4')
@section('title','Agregar usuario')
@section('return')
{{ route('usuarios.index') }}
@endsection
@section('header','Agregar usuario')
@section('content')
</script>
<form class="form form-md" method="post" action="{{ route('usuarios.store') }}" id="form">
    @csrf
    <div style="width: 100%;">
        <label>Nombre:</label>
        <input type="text" name="name" class="form-input" value="{{ old('name') }}">
        @if($errors->has('name'))
        <div class="alert alert-danger">
            <span>{{ $errors->first('name') }}</span>
        </div>
        @endif
        <label>Teléfono:</label>
        <input type="text" name="phone" class="form-input" value="{{ old('phone') }}">
        @if($errors->has('phone'))
        <div class="alert alert-danger">
            <span>{{ $errors->first('phone') }}</span>
        </div>
        @endif
        <label>Correo:</label>
        <input type="email" name="email" class="form-input" value="{{ old('email') }}">
        @if($errors->has('email'))
        <div class="alert alert-danger">
            <span>{{ $errors->first('email') }}</span>
        </div>
        @endif
        <label>Contraseña:</label>
        <input type="password" name="password" class="form-input">
        @if($errors->has('pass'))
        <div class="alert alert-danger">
            <span>{{ $errors->first('pass') }}</span>
        </div>
        @endif
        <label>Lugar:</label>
        <select name="place_id" tabindex="-1">
            @foreach($places as $place)
            <option value="{{ $place->id }}" >{{ $place->domain.' | '.$place->municipality.' | '.$place->address }}</option>
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
            <option value="{{ $role->id }}" >{{ $role->name }}</option>
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
            <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </select>
        @if($errors->has('department_id'))
        <div class="alert alert-danger">
            <span>{{ $errors->first('department_id') }}</span>
        </div>
        @endif
        <div id="task-types-div" style="display: none;">
            <label>Tipos de actividades (sólo para técnicos):</label>
            <table  style="margin-left: 20px">
                @foreach($task_types as $task_type)
                <tr>
                    <td>
                        <input type="checkbox" name="task_types[]" class="tp" value="{{ $task_type->id }}">
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
    <button class="btn-agregar btn btn-normal" type="submit">Crear</button>
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