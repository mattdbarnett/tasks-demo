<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller {

    public function getTaskById(Request $request) {

        /**
         * Get the Task ID from request
         */
        $taskId = $request->id;

        /**
         * Throw an error if we don't have a valid Task ID.
         */
        if( $taskId === null || $taskId === false ) {
            return Response::json(
                array(
                    'code'      =>  400,
                    'message'   =>  "Invalid task ID."
                ), 
                400
            );
        }

        /**
         * Query the database using the valid Task ID.
         */
        $query = 'SELECT * FROM tdtask10 WHERE TASK10_ID = ' . $taskId . ' AND TASK10_DFLG = 0';
        $taskData = DB::select($query);

        /**
         * Throw an error if a Task with that ID doesn't exist.
         */
        if( $taskData === null || $taskData === false || empty($taskData) ) {
            return Response::json(
                array(
                    'code'      =>  400,
                    'message'   =>  "Task no longer exists."
                ), 
                400
            );
        }

        /**
         * Convert Task Data into Task Object
         */
        $task = new Task;
        $task->constructFromObj($taskData);

        /**
         * Return valid Task
         */
        return response()->json($task);
    }

}