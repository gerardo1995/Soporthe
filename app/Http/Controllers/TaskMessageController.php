<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Task;
use App\TaskMessage;

class TaskMessageController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('US/Central');
    }
    public function index(Task $task){
    	$task_messages = TaskMessage::all();
        return view('chat',compact('task','task_messages'));
    }

    public function store(Request $request){
    	$request->validate([
            'content'=>'required'
        ]);
        $task_message = new TaskMessage([
        	'task_id'=> $request->input('task_id'),
          	'user_id'=> Auth::id(),
          	'content'=>$request->input('content')
        ]);
        $task_message->save();
        return redirect()->route('chat.index',$request->input('task_id'));
    }
}


