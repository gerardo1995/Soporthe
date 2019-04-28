<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DepartmentStoreRequest;
use App\Http\Requests\DepartmentUpdateRequest;
use App\Department;
class DepartmentController extends Controller
{

     public function __construct()
    {
        date_default_timezone_set('US/Central');
    }
    public function index(Request $request)
    {
        $search = $request->input('search');
        $departments = Department::orderBy('name','asc')
            ->search($search)
            ->paginate(20);
        return view('admin_menu.departments',compact('departments','search'));
    }

    public function create()
    {
        return view('admin_menu.add_department');
    }

    public function store(DepartmentStoreRequest $request)
    {
        $department = new Department(
            ['name'=>$request->input('name')
        ]);
        $department->save();
        return redirect()->route('departamentos.index');
    }

    public function edit($id)
    {
        $department = Department::find($id);
        return view('admin_menu.edit_department',compact('department'));
    }

    public function update(DepartmentUpdateRequest $request, $id)
    {
        $department = Department::find($id);
        $department->name =$request->input('name');
        $department->save();
        return redirect()->route('departamentos.index');
    }

    public function destroy($id)
    {
        $department = Department::find($id);
        $department->delete();
        return redirect()->route('departamentos.index');
    }
}
