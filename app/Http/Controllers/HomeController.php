<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Models\Task;

use App\Services\TaskService;

class HomeController extends Controller {

    public function index() {
        
        $taskService = new TaskService;
        $tasks = $taskService->getTasks();

        return view('home', ['tasks' => $tasks]);
    }

}