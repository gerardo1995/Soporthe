<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\TaskTypeStoreRequest;
use App\Http\Requests\TaskTypeUpdateRequest;
use App\TaskType;


class TaskTypeController extends Controller
{
     public function __construct()
    {
        date_default_timezone_set('US/Central');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $task_types = TaskType::orderBy('name','asc')
            ->search($search)
            ->paginate(20);
            return view('admin_menu.task_types',compact('task_types','search'));
    }

    public function create()
    {
         return view('admin_menu.add_task_type');
    }

    public function store(TaskTypeStoreRequest $request)
    {
        $task_type = new TaskType(['name'=>$request->input('name')]);
        $task_type->save();

        return redirect()->route('actividades.index');
    }

    public function edit($id)
    {
        $task_type=TaskType::find($id);
        return view('admin_menu.edit_task_type',compact('task_type'));
    }

    public function update(TaskTypeUpdateRequest $request, $id)
    {
        $task_type = TaskType::find($id);
        $task_type->name =$request->input('name');
        $task_type->save();
        return redirect()->route('actividades.index');
    }

    public function destroy($id)
    {
        TaskType::find($id)->delete();
        return redirect()->route('actividades.index');

    }
}
