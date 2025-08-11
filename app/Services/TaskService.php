<?php

namespace App\Services;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

use App\Models\Task;

class TaskService {
    
    public function getTaskById($taskId) {

        /**
         * Throw an error if we don't have a valid Task ID.
         */
        if( $taskId === null || $taskId === false ) {
            return response()->json(
                array(
                    'code'      =>  400,
                    'message'   =>  "Invalid task ID."
                ), 
                400
            );
        }

        /**
         * Query the database with Eloquent using the valid Task ID.
         */
        $taskData = DB::table('tdtask10')->where('TASK10_ID', $taskId)->where('TASK10_DFLG', '0')->first();

        /**
         * Throw an error if a Task with that ID doesn't exist.
         */
        if( $taskData === null || $taskData === false || empty($taskData) ) {
            return response()->json(
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

        return $task;
    }

    public function getTasks() {
        $tasksData = DB::select('SELECT * FROM tdtask10 WHERE TASK10_DFLG = 0');

        $tasks = array();
        foreach ($tasksData as $taskData) {
            $newTask = new Task();
            $newTask->constructFromObj($taskData);
            $tasks[] = $newTask;
        }

        return $tasks;
    }

    public function createTask($TASK10_TITL, $TASK10_DESC, $TASK10_STUS, $TASK10_DUED) {

        /**
         * Validate that our fields are valid.
         */
        if ( ( !is_string($TASK10_TITL) || strlen($TASK10_TITL) < 0 ) && strlen($TASK10_TITL) > 255 ) {
            return response()->json(
                array(
                    'code'      =>  400,
                    'message'   =>  "Invalid Task Title."
                ), 
                400
            );
        }

        if ( !is_string($TASK10_DESC) || strlen($TASK10_DESC) > 65535 ) {
            return response()->json(
                array(
                    'code'      =>  400,
                    'message'   =>  "Invalid Task Description."
                ), 
                400
            );
        }

        if ( !in_array($TASK10_STUS, Task::getStatusValues()) ) {
            return response()->json(
                array(
                    'code'      =>  400,
                    'message'   =>  "Invalid Task Status. Status must be one of: " . implode(", ", Task::getStatusValues())
                ), 
                400
            );
        }

        if ( !strtotime($TASK10_DUED) ) {
            return response()->json(
                array(
                    'code'      =>  400,
                    'message'   =>  "Invalid Task Due Date."
                ), 
                400
            );
        }

        /**
         * Initalise new task object
         */
        $task = new Task(
            null, 
            $TASK10_TITL, 
            $TASK10_DESC, 
            $TASK10_STUS, 
            $TASK10_DUED
        );

        /**
         * Create the task row
         */
        $dbResponse = DB::table('tdtask10')->insert([
            'TASK10_TITL' => $task->getTitle(),
            'TASK10_DESC' => $task->getDesc(),
            'TASK10_STUS' => $task->getStatusValue(),
            'TASK10_DUED' => $task->getDueDate(),
            'TASK10_CRTD' => date('Y-m-d H:i:s'),
            'TASK10_CRTU' => 0,
            'TASK10_CRTP' => 'TaskController - createTask',
            'TASK10_LUPD' => date('Y-m-d H:i:s'),
            'TASK10_LUPU' => 0,
            'TASK10_LUPP' => 'TaskController - createTask',
            'TASK10_DFLG' => 0,
        ]);

        /**
         * Check if the insert was successful
         */
        if ($dbResponse) {
            return $dbResponse;
        } else {
            return response()->json(
                array(
                    'code'      =>  500,
                    'message'   =>  "Failed to create task. Please contact a system administrator."
                ), 
                500
            );
        }

    }

    public function updateTask($TASK10_ID, $TASK10_TITL, $TASK10_DESC, $TASK10_STUS, $TASK10_DUED) {

        /**
         * Validate that our fields are valid.
         */
        if ( !$TASK10_ID ) {
            return response()->json(
                array(
                    'code'      =>  400,
                    'message'   =>  "Invalid Task ID."
                ), 
                400
            );
        }

        if ( ( !is_string($TASK10_TITL) || strlen($TASK10_TITL) < 0 ) && strlen($TASK10_TITL) > 255 ) {
            return response()->json(
                array(
                    'code'      =>  400,
                    'message'   =>  "Invalid Task Title."
                ), 
                400
            );
        }

        if ( !is_string($TASK10_DESC) || strlen($TASK10_DESC) > 65535 ) {
            return response()->json(
                array(
                    'code'      =>  400,
                    'message'   =>  "Invalid Task Description."
                ), 
                400
            );
        }

        if ( !in_array($TASK10_STUS, Task::getStatusValues()) ) {
            return response()->json(
                array(
                    'code'      =>  400,
                    'message'   =>  "Invalid Task Status. Status must be one of: " . implode(", ", Task::getStatusValues())
                ), 
                400
            );
        }

        if ( !strtotime($TASK10_DUED) ) {
            return response()->json(
                array(
                    'code'      =>  400,
                    'message'   =>  "Invalid Task Due Date."
                ), 
                400
            );
        }

        /**
         * Initalise our new task object using fields from the current version
         */
        $task = new Task();
        $task->constructFromInput($TASK10_ID, $TASK10_TITL, $TASK10_DESC, $TASK10_STUS, $TASK10_DUED);

        /**
         * Update the DB
         */
        $dbResponse = DB::table('tdtask10')
            ->where('TASK10_ID', $task->getId())
            ->where('TASK10_DFLG', 0)
            ->limit(1)
            ->update([
            'TASK10_TITL' => $task->getTitle(),
            'TASK10_DESC' => $task->getDesc(),
            'TASK10_STUS' => $task->getStatusValue(),
            'TASK10_DUED' => $task->getDueDate(),
            'TASK10_LUPD' => date('Y-m-d H:i:s'),
            'TASK10_LUPU' => 0,
            'TASK10_LUPP' => 'TaskController - updateTask'
        ]);

        /**
         * Check if the insert was successful
         */
        if ($dbResponse) {
            return true;
        } else {
            return response()->json(
                array(
                    'code'      =>  500,
                    'message'   =>  "Failed to update task. Please contact a system administrator."
                ), 
                500
            );
        }
    }

    public function deleteTask($TASK10_ID) {

        /**
         * Validate that our fields are valid.
         */
        if ( !$TASK10_ID ) {
            return response()->json(
                array(
                    'code'      =>  400,
                    'message'   =>  "Invalid Task ID."
                ), 
                400
            );
        }

        /**
         * Logically delete the task by setting the delete flag to 1
         */
        $dbResponse = DB::table('tdtask10')
            ->where('TASK10_ID', $TASK10_ID)
            ->where('TASK10_DFLG', 0)
            ->update(['TASK10_DFLG' => 1]);

        /**
         * Check if the update was successful
         */
        if ($dbResponse) {
            return true;
        } else {
            return response()->json(
                array(
                    'code'      =>  500,
                    'message'   =>  "Failed to delete task. Task does not exist or may have already been deleted."
                ), 
                500
            );
        }
    }

}