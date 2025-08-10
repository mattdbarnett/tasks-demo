<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\Task;

class HomeController extends Controller {

    public function index() {
        $tasksData = DB::select('SELECT * FROM tdtask10 WHERE TASK10_DFLG = 0');

        $tasks = array();
        foreach ($tasksData as $taskData) {
            $newTask = new Task();
            $newTask->constructFromObj($taskData);
            $tasks[] = $newTask;
        }

        return view('home', ['tasks' => $tasks]);
    }

}