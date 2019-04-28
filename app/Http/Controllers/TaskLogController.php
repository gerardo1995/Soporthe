<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\TaskLog;

class TaskLogController extends Controller
{

     public function __construct()
    {
        date_default_timezone_set('US/Central');
    }
      public function index(Request $request)
    {
      $search = $request->input('search');
      $task_logs = TaskLog::orderBy('created_at','desc')
        ->search($search)
        ->paginate(20);
      return view('/client_menu/task_logs',compact('task_logs','search'));
    }

    public function destroy(TaskLog $task_log)
    {
        $task_log->delete();
        return redirect()->route('task_logs.index');
    }
}
