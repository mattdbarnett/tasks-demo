<?php
namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Mode;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller {

    public function viewTask(Request $request) {
        /**
         * Get request variables
         */
        $taskId = $request->id;
        $mode = $request->mode;

        /**
         * If we're in create mode, instance a task without an ID.
         * 
         * If we're in edit or view mode, get the current Task using our ID.
         * If it's a json response, return that instead as the process failed.
         */
        if ( $mode === Mode::CREATE_MODE ) {
            $task = new Task();
        } else {
            $task = $this->getTaskById($taskId);
            if ( $task instanceof Response ) {
                return $task;
            }
        }

        /**
         * Create a title based on our current mode
         */
        $title = 'INVALID';
        switch ($mode) {
            case Mode::VIEW_MODE:
                $title = 'View Task ' . $task->getIdShort();
                break;
            case Mode::CREATE_MODE:
                $title = 'Create Task';
                break;
            case Mode::EDIT_MODE:
                $title = 'Edit Task ' . $task->getIdShort();
                break;
        }

        /**
         * Generate a modal view using our current mode, title and task
         */
        $taskView = view(
            'partials.task-view', 
            [
                'mode' => $mode,
                'title' => $title,
                'task' => $task
            ]
        );
        $html = $taskView->render();

        /**
         * Return modal view to JS
         */
        return response()->json(['mode' => Mode::EDIT_MODE, 'html' => $html]);
    }

    public function createTask(Request $request) {
        /**
         * Initalise new task object
         */
        $task = new Task(
            null, 
            $request->TASK10_TITL, 
            $request->TASK10_DESC, 
            $request->TASK10_STUS, 
            $request->TASK10_DUED
        );

        /**
         * Create the task row
         */
        $query = 
            'INSERT INTO 
                tdtask10
                (TASK10_TITL,
                TASK10_DESC,
                TASK10_STUS,
                TASK10_DUED,
                TASK10_CRTD,
                TASK10_CRTU,
                TASK10_CRTP,
                TASK10_LUPD,
                TASK10_LUPU,
                TASK10_LUPP,
                TASK10_DFLG)
            VALUES
                (   
                    "' . $task->getTitle() . '",
                    "' . $task->getDesc() . '",
                    "' . $task->getStatusValue() . '",
                    "' . $task->getDueDate() . '",
                    "' . date('Y-m-d H:i:s') . '",
                    0,
                    "TaskController - createTask",
                    "' . date('Y-m-d H:i:s') . '",
                    0,
                    "TaskController - createTask",
                    0
                );
            ';
                
        $dbResponse = DB::insert($query);

        /**
         * Return database response
         */
        return response()->json(['success' => $dbResponse]);
    }

    public function updateTask(Request $request) {
        /**
         * Initalise new task object
         */
        $task = new Task(
            $request->TASK10_ID, 
            $request->TASK10_TITL, 
            $request->TASK10_DESC, 
            $request->TASK10_STUS, 
            $request->TASK10_DUED
        );

        /**
         * Update the DB
         */
        $query = 
            'UPDATE 
                tdtask10 
            SET 
                TASK10_TITL = "' . $task->getTitle() . '", 
                TASK10_DESC = "' . $task->getDesc() . '", 
                TASK10_STUS = ' . $task->getStatusValue() . ', 
                TASK10_DUED = "' . $task->getDueDate() . '", 
                TASK10_LUPD = "' . date('Y-m-d H:i:s') . '", 
                TASK10_LUPU = 0, 
                TASK10_LUPP = "TaskController - updateTask" 
            WHERE 
                TASK10_ID = ' . $task->getId() . ' 
            AND 
                TASK10_DFLG = 0';
                
        $dbResponse = DB::update($query);
        $success = ( $dbResponse === 1 ) ? true : false;

        /**
         * Return database response
         */
        return response()->json(['success' => $success]);
    }

    public function warningTask(Request $request) {
        /**
         * Get request variables
         */
        $taskId = $request->id;

        /**
         * Make new Task object
         */
        $task = new Task($taskId);

        /**
         * Convert valid Task into view
         */
        $taskView = view(
            'partials.task-view', 
            [
                'mode' => Mode::WARNING_MODE,
                'title' => "Delete Task " . $task->getIdShort(), 
                'task' => $task
            ]
        );
        $html = $taskView->render();

        /**
         * Return database response
         */
        return response()->json(['html' => $html]);
    }

    public function deleteTask(Request $request) {
        /**
         * Get request variables
         */
        $taskId = $request->id;

        /**
         * Make new Task object
         */
        $task = new Task($taskId);

        /**
         * Delete task in DB
         */
        $query = 
            'UPDATE 
                tdtask10 
            SET 
                TASK10_LUPD = "' . date('Y-m-d H:i:s') . '", 
                TASK10_LUPU = 0, 
                TASK10_LUPP = "TaskController - deleteTask",
                TASK10_DFLG = 1 
            WHERE 
                TASK10_ID = ' . $task->getId() . '
            AND 
                TASK10_DFLG = 0';
                
        $dbResponse = DB::update($query);
        $success = ( $dbResponse === 1 ) ? true : false;

        /**
         * Return database response
         */
        return response()->json(['success' => $success]);
    }

    private function getTaskById($taskId) {

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
         * Query the database with Eloquent using the valid Task ID.
         */
        $taskData = DB::table('tdtask10')->where('TASK10_ID', $taskId)->where('TASK10_DFLG', '0')->first();

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

        return $task;
    }

}