<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserUpdateProfileRequest;
use Illuminate\Support\Facades\Hash;
use App\Department;
use App\User;
use App\Role;
use App\Place;
use App\UsersXTaskType;
use App\TaskType;
use App\Task;

class UserController extends Controller
{

     public function __construct()
    {
        date_default_timezone_set('US/Central');
    }
    public function index(Request $request)
    {
        // $users = User::orderBy('name','asc')->paginate(20);
        $search = $request->input('search');
        $users = User::where('id','!=',Auth::id())
            ->orderBy('name','asc')
            ->search($search)
            ->paginate(20);
        return view('admin_menu.users',compact('users','search'));
    }

    public function create()
    {
        $task_types = TaskType::all();
        $places = Place::all();

        $role = User::where('role_id', 4)->get();
        $departments = Department::all();

        if ($role->isEmpty()) {

            $roles = Role::all();

            return view('admin_menu.add_user',compact('roles','departments','task_types','places'));
        }
        else
        {
            $roles = Role::find([1, 2, 3]);

          return view('admin_menu.add_user',compact('roles','departments','task_types','places'));
        }
    }

    public function store(UserStoreRequest $request)
    {
        $role_id= $request->input('role_id');
        $email = $request->input('email');
        $user_deleted = User::onlyTrashed()->where('email',$email)->first();
        if($user_deleted == NULL){
            $user = new User(['department_id'=>$request->input('department_id'),
                                 'role_id'=>$role_id,
                                 'place_id'=>$request->input('place_id'),
                                 'name'=>$request->input('name'),
                                 'email'=>$request->input('email'),
                                 'password'=>Hash::make($request->input('password')),
                                 'phone'=>$request->input('phone')]);
            $user->save();

            $task_types = $request->input('task_types');
            if($task_types != null && $request->input('role_id') == 2){
                for ($i=0; $i < count($task_types) ; $i++) {
                    $user_x_task_type = new UsersXTaskType(['task_type_id'=>$task_types[$i],'user_id'=>$user->id]);
                    $user_x_task_type->save();
                }
            }

        }else{
            $user_deleted->restore();
            $user_deleted->update($request->except(['']));
            $user_deleted->password = Hash::make($request->input('password'));
            $task_types = $request->input('task_types');
            if($task_types != null && $request->input('role_id') == 2){
                for ($i=0; $i < count($task_types) ; $i++) {
                    $user_x_task_type = new UsersXTaskType(['task_type_id'=>$task_types[$i],'user_id'=>$user_deleted->id]);
                    $user_x_task_type->save();
                }
            }
            $user_deleted->save();
        }
            return redirect()->route('usuarios.index');
    }
     public function update(UserUpdateRequest $request, $id)
    {
        $user = User::find($id);
        $email = $request->input('email');
        $user_deleted = User::onlyTrashed()->where('email',$email)->first();
        $task_types = $request->input('task_types');
        if($user_deleted == NULL){
            UsersXTaskType::where('user_id',$id)->delete();
            if($task_types != null && $request->input('role_id') == 2){
                for ($i=0; $i < count($task_types) ; $i++) {
                    $user_x_task_type = new UsersXTaskType(['task_type_id'=>$task_types[$i],'user_id'=>$user->id]);
                    $user_x_task_type->save();
                }
            }
            $user->update($request->except(['task_types']));
        }else{
            if($request->input('role_id') == 3){
                UsersXTaskType::where('user_id',$id)->delete();
            }elseif($request->input('role_id')==2){
                Task::where('client_id',$id)->delete();
            }else{
                UsersXTaskType::where('user_id',$id)->delete();
                Task::where('client_id',$id)->delete();
            }
            $user->delete();
            $user_deleted->restore();
            $user_deleted->update($request->except(['']));
            if($task_types != null){
                for ($i=0; $i < count($task_types) ; $i++) {
                    $user_x_task_type = new UsersXTaskType(['task_type_id'=>$task_types[$i],'user_id'=>$user_deleted->id]);
                    $user_x_task_type->save();
                }
            }
        }
        if(url()->previous() == route('usuarios.show',$id)){
            return redirect()->route('usuarios.show',compact('user'));
        }else{
            return redirect()->route('usuarios.index');
        }
    }

    public function edit($id)
    {
        $user=User::find($id);
        $task_types = TaskType::all();
        $places = Place::all();

        $role = User::where('role_id', 4)->get();
        $departments = Department::all();

        if ($role->isEmpty() || $user->role_id == 4) {
            $roles = Role::all();
        }else{
            $roles = Role::find([1, 2, 3]);
        }
        return view('admin_menu.edit_user',compact('user','task_types','places','roles','departments'));

    }

    public function editProfile($id)
    {
        $user=User::find($id);
        return view('edit_profile',compact('user'));
    }

    public function showProfile($id)
    {
        $user=User::find($id);
        return view('show_profile',compact('user'));
    }
    public function show($id)
    {
        $user=User::find($id);
        return view('admin_menu/show_user',compact('user'));
    }


    public function updateProfile(UserUpdateProfileRequest $request, $id)
    {
        $email = $request->input('email');
        $user_deleted = User::onlyTrashed()->where('email',$email)->first();
        $logged_user = User::find($id);
        if($user_deleted == NULL){
            $logged_user->update($request->except(['']));
        }else{
            $user_deleted->email = 'temorary value';
            $user_deleted->save();
            $logged_email = $logged_user->email;
            $logged_user->update($request->except(['']));
            $user_deleted->email = $logged_email;
            $user_deleted->save();

        }
        return redirect()->route('show.profile',compact('id'));
    }

    public function destroy($id)
    {
        $user=User::find($id);
        $user->delete();
        UsersXTaskType::where('user_id',$id)->delete();
        Task::where('client_id',$id)->delete();
        return redirect()->route('usuarios.index');
    }
}
