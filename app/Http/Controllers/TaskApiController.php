<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Services\TaskService;

class TaskApiController extends Controller {

    public function getTask(Request $request) {

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
        $task = $taskService->getTaskById($TASK10_ID);

        /**
         * If the task is a JsonResponse, it means an error occurred.
         */
        if ( $task instanceof JsonResponse ) {
            return $task;
        }

        return response()->json(
            array(
                'code'      => 200,
                'task'      => $task, 
                'message' => 'Succesfully retrieved Task'
            ), 
            200
        );
    }

     public function getTasks() {

        $taskService = new TaskService();
        $tasks = $taskService->getTasks();

        /**
         * If the task is a JsonResponse, it means an error occurred.
         */
        if ( $tasks instanceof JsonResponse ) {
            return $tasks;
        }

        return response()->json(
            array(
                'code'      => 200,
                'tasks'      => $tasks, 
                'message' => 'Succesfully retrieved Task'
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
            return $dbResponse;
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

    public function updateTaskStatus(Request $request) {

        /**
         * Get & verify request variables
         */
        $TASK10_ID = ( $request->TASK10_ID ) ? $request->TASK10_ID : false;
        $TASK10_STUS = ( $request->TASK10_STUS ) ? $request->TASK10_STUS : false;

        if ( $TASK10_ID === false ||
             $TASK10_STUS === false ) {
            return response()->json(
                array(
                    'code'      =>  400,
                    'message'   =>  "Missing essential Task field(s)."
                ), 
                400
            );
        }
    
        /**
         * Initalise our new task object using fields from the current version
         */
        $taskService = new TaskService();
        $oldTask = $taskService->getTaskById($TASK10_ID);
        if ( $oldTask instanceof JsonResponse ) {
            return $oldTask;
        }

        /**
         * Update the DB
         */
        $dbResponse = $taskService->updateTask($oldTask->getId(), $oldTask->getTitle(), $oldTask->getDesc(), $TASK10_STUS, $oldTask->getDueDate());

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

        return response()->json(
            array(
                'code'      => 200,
                'message'   => 'Succesfully deleted Task'
            ), 
            200
        );
    }
}