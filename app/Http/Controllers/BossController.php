<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Task;
use PDF;
class BossController extends Controller
{
	public function __construct()
    {
        date_default_timezone_set('US/Central');
    }
    public function downloadPDF(){;



    }
    public function showPDF(Request $request){
        $date1 = $request->date1;
        $date2 = $request->date2;
        if($request->date1 == null ||$request->date2==null){
            $date1 = date('Y-m-01');
            $date2 = date('Y-m-d');
        }
        $datetime1 = "$date1 00:00:00";
        $datetime2 = "$date2 23:59:59";
        $tasks = Task::withTrashed()
            ->where('task_state_id','4')
            ->whereBetween('updated_at',array($datetime1,$datetime2))
            ->get();
        $Data = $this->getGraphData($datetime1,$datetime2);
        $pdf = PDF::loadView('/boss_menu/pdf', compact('Data','tasks','date1','date2'));
        return $pdf->stream('Tareas_verificadas_por_departamento_'.$date1.'_'.$date2.'.pdf');
        // return view('/boss_menu/pdf',compact('Data','tasks'));
    }


    public function index(Request $request) {
        $date1 = $request->date1;
        $date2 = $request->date2;

    	if($request->date1 == null ||$request->date2==null){
    		$date1 = date('Y-m-01');
    		$date2 = date('Y-m-d');
    	}

    	$datetime1 = "$date1 00:00:00";
    	$datetime2 = "$date2 23:59:59";
    	$Data = $this->getGraphData($datetime1,$datetime2);
      	return view('boss_menu.dashboard',compact('Data','date1','date2'));
    }
    private function getGraphData($datetime1 , $datetime2){
        $Data = DB::select(
            DB::raw(
                "select departments.name, count(departments.name) as value
                from tasks
                inner join users
                on (tasks.client_id = users.id)
                inner join departments
                on (users.department_id = departments.id)
                where (tasks.updated_at BETWEEN '$datetime1' AND '$datetime2' && tasks.task_state_id = 4)
                group by departments.name
                having count(departments.name)
                order by count(departments.name) desc;"
            )
        );
        return $Data;
    }
}
