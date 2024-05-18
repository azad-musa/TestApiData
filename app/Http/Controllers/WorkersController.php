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
}
?>
