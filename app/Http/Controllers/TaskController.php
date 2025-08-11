<?php
namespace App\Http\Controllers;

use Exception;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

use App\Models\Task;
use App\Models\Mode;

use App\Services\TaskService;

class TaskController extends Controller {

    public function viewTask(Request $request) {

        $TASK10_ID = ( $request->TASK10_ID ) ? $request->TASK10_ID : false;
        $mode = ( $request->mode ) ? $request->mode : Mode::VIEW_MODE;

        if ( $TASK10_ID === false && $mode !== Mode::CREATE_MODE ) {
            return response()->json(
                array(
                    'code'      =>  400,
                    'message'   =>  "Missing essential ID Field."
                ), 
                400
            );
        }

        /**
         * If we're in create mode, instance a task without an ID.
         * 
         * If we're in edit or view mode, get the current Task using our ID.
         * If it's a json response, return that instead as the process failed.
         */
        if ( $mode === Mode::CREATE_MODE ) {
            $task = new Task();
        } else {
            $taskService = new TaskService();
            $task = $taskService->getTaskById($TASK10_ID);
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
        return response()->json(
            array(
                'code' => 200,
                'html' => $html
            ),
            200
        );
    }

    public function createTask(Request $request) {

        /**
         * Get & verify request variables
         */
        $TASK10_TITL = ( $request->TASK10_TITL ) ? $request->TASK10_TITL : false;
        $TASK10_DESC = ( $request->TASK10_DESC ) ? $request->TASK10_DESC : '';
        $TASK10_STUS = ( $request->TASK10_STUS || 
                         $request->TASK10_STUS === 0 ||
                         $request->TASK10_STUS === "0" ) ? $request->TASK10_STUS : false;
        $TASK10_DUED = ( $request->TASK10_DUED ) ? $request->TASK10_DUED : false;  

        if ( $TASK10_TITL === false ||
             $TASK10_STUS === false || 
             $TASK10_DUED === false ) {
            return response()->json(
                array(
                    'code'      =>  400,
                    'message'   =>  "Missing essential Task field(s)."
                ), 
                400
            );
        }

        $taskService = new TaskService();
        $dbResponse = $taskService->createTask($TASK10_TITL, $TASK10_DESC, $TASK10_STUS, $TASK10_DUED);

        /**
         * If the task is a JsonResponse, it means an error occurred.
         */
        if ( $dbResponse instanceof JsonResponse ) {
            return response()->json(
                array(
                    'code'      =>  400,
                    'message'   =>  "Failed to create Task.",
                    'error'     => $dbResponse->getData()->message
                ),
            );
        }

        /**
         * Return success response
         */
        return response()->json(
            array(
                'code'      => 200,
                'message'   => "Task created successfully."
            ),
            200
        );
    }

    public function updateTask(Request $request) {

        /**
         * Get & verify request variables
         */
        $TASK10_ID = ( $request->TASK10_ID ) ? $request->TASK10_ID : false;
        $TASK10_TITL = ( $request->TASK10_TITL ) ? $request->TASK10_TITL : false;
        $TASK10_DESC = ( $request->TASK10_DESC ) ? $request->TASK10_DESC : '';
        $TASK10_STUS = ( $request->TASK10_STUS || 
                         $request->TASK10_STUS === 0 ||
                         $request->TASK10_STUS === "0" ) ? $request->TASK10_STUS : false;
        $TASK10_DUED = ( $request->TASK10_DUED ) ? $request->TASK10_DUED : false;  

        if ( $TASK10_ID === false ||
             $TASK10_TITL === false ||
             $TASK10_STUS === false || 
             $TASK10_DUED === false ) {
            return response()->json(
                array(
                    'code'      =>  400,
                    'message'   =>  "Missing essential Task field(s)."
                ), 
                400
            );
        }

        /**
         * Update the DB
         */
        $taskService = new TaskService();
        $dbResponse = $taskService->updateTask($TASK10_ID, $TASK10_TITL, $TASK10_DESC, $TASK10_STUS, $TASK10_DUED);

        /**
         * If the task is a JsonResponse, it means an error occurred.
         */
        if ( $dbResponse instanceof JsonResponse ) {
            return $dbResponse;
        }

        /**
         * Return database response
         */
        return response()->json(
            array(
                'code'      => 200,
                'message'   => "Task updated successfully."
            ), 
            200
        );
    }

    public function warningTask(Request $request) {

        /**
         * Get request variables
         */
        $TASK10_ID = ( $request->TASK10_ID ) ? $request->TASK10_ID : false;

        if ( $TASK10_ID === false  ) {
            return response()->json(
                array(
                    'code'      =>  400,
                    'message'   =>  "Missing essential ID Field."
                ), 
                400
            );
        }

        /**
         * Make new Task object
         */
        $task = new Task($TASK10_ID);

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
        return response()->json(
            array(
                'code'      => 200,
                'html'      => $html
            ),
            200
        );
    }

    public function deleteTask(Request $request) {

        /**
         * Get & verify request variables
         */
        $TASK10_ID = ( $request->TASK10_ID ) ? $request->TASK10_ID : false;

        if ( $TASK10_ID === false ) {
            return response()->json(
                array(
                    'code'      =>  400,
                    'message'   =>  "Missing essential ID Field."
                ), 
                400
            );
        }

        $taskService = new TaskService();
        $task = $taskService->deleteTask($TASK10_ID);

        /**
         * If the task is a JsonResponse, it means an error occurred.
         */
        if ( $task instanceof JsonResponse ) {
            return $task;
        }

        /**
         * Return database response
         */
        return response()->json(
            array(
                'code'      => 200,
                'message'   => 'Succesfully deleted Task'
            ),
            200
        );
    }

}