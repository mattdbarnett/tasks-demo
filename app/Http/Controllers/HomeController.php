<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends Controller {

    public function index() {

        $tasks = DB::select('SELECT * FROM tdtask10 WHERE TASK10_DFLG = 0');

        return view('home', ['tasks' => $tasks]);
    }

}