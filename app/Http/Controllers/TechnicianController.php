<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Task;
use App\TaskLog;
class TechnicianController extends Controller
{
   	public function __construct()
    {
        date_default_timezone_set('US/Central');
    }
	private $tasks;

	public function pending(){
    	$tasks = Task::all()->where('technician_id',Auth::id());
      return view('technician_menu.pending',compact('tasks'));
    }
    public function initiated(){
      $tasks = Task::all()->where('technician_id',Auth::id());
  		return view('technician_menu.initiated',compact('tasks'));
    }
    public function finished(){
      $tasks = Task::all()->where('technician_id',Auth::id());
  		return view('technician_menu.finished',compact('tasks'));
    }


    public function showAnnotation(Task $task){
        return view('technician_menu.annotation.show',compact('task'));
    }

    public function editAnnotation(Task $task){
      if($task->technician_id==Auth::id()){
        return view('technician_menu.annotation.edit',compact('task'));
      }else{
        return abort(404);
      }
    }
    public function updateAnnotation(Request $request,Task $task){
      $task->update($request->all());
      return redirect()->route('show task annotation', $task->id);
    }

    public function updateState(Request $request,Task $task){
      $request->validate([
        'task_state_id'=>'required'
      ]);
      $task->update($request->all());
      $task->save();
      $task_log = new TaskLog([
        'task_id' => $task->id,
        'task_state_id' => $task->task_state_id,
        'user_id' => Auth::id()
      ]);
      $task_log->save();
      return redirect()->back();
    }
}
