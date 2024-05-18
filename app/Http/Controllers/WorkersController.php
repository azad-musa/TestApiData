<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkersController extends Controller
{
    public function GetWorkers(Request $request)
    {
        $users = DB::table('workers')->select('worker_name', 'worker_email')->get();

        return response()->json($users);
    }

    public function GetWorkersDetailed(Request $request)
    {
        $workers = DB::select('
            SELECT 
                w.worker_id, 
                w.worker_name, 
                w.worker_email, 
                d.department_name, 
                r.role_name
            FROM workers w
            INNER JOIN departments d ON w.worker_department_id = d.department_id
            INNER JOIN roles r ON w.worker_role_id = r.role_id
        ');

        return response()->json($workers);
    }

    public function GetWorkerById(Request $request)
    {
        $request->validate([
            'worker_id' => 'required|integer'
        ]);

        $worker_id = $request->input('worker_id');

        $worker = DB::select('
            SELECT 
                w.worker_id, 
                w.worker_name, 
                w.worker_email, 
                d.department_name, 
                r.role_name
            FROM workers w
            INNER JOIN departments d ON w.worker_department_id = d.department_id
            INNER JOIN roles r ON w.worker_role_id = r.role_id
            WHERE w.worker_id = :worker_id
        ', ['worker_id' => $worker_id]);

        return response()->json($worker);
    }
}
?>
