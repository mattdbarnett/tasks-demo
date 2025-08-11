<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    @vite('resources/js/home.js')
</head>

<body class="relative p-8 lg:p-16 bg-white">
    
    <div id="action-header" class="flex flex-col xl:flex-row gap-6">
        <div class="flex items-center px-10 py-6 rounded-xl bg-gray-200">
            <h1 class="text-4xl font-bold whitespace-wrap lg:whitespace-nowrap">Tasks Demo for DTS</h1>
        </div>
        <div class="flex flex-col lg:flex-row gap-2 item-center w-full px-8 py-6 rounded-xl bg-gray-100">
            <a id="task-create-btn" class="inline-block min-h-[48px] px-6 py-3 rounded-xl bg-green-400 hover:bg-green-500 text-white font-bold cursor-pointer transition"">
                Create a Task
            </a>
            <!-- <a class="inline-block min-h-[48px] px-6 py-3 rounded-xl bg-gray-400 hover:bg-gray-500 text-white font-bold cursor-pointer transition"">
                Dump Tasks
            </a>
            <a class="inline-block min-h-[48px] px-6 py-3 rounded-xl bg-red-400 hover:bg-red-500 text-white font-bold cursor-pointer transition"">
                Delete All
            </a> -->
        </div>
    </div>

    <!-- Popup HTML -->
    
    <?php
    $popupDisplay = 
        ( isset($_GET['create-success']) ||
          isset($_GET['edit-success']) || 
          isset($_GET['delete-success']) ) ? 'flex' : 'hidden';
    $popupText = '';
    $popupBg = 'bg-blue-400';
    $popupRowId = ( isset($_GET['id']) ) ? (float) $_GET['id'] : null;

    if ( isset($_GET['create-success']) ) {
        if ( $_GET['create-success'] === 'true') {
            $popupBg = 'bg-blue-400';
            $popupText = 'Task has been successfully created!';
        } else {
            $popupBg = 'bg-red-400';
            $popupText = 'Task creation failed. Please contact a systems administrator.';
        }
    }

    if ( isset($_GET['edit-success']) ) {
        if ( $_GET['edit-success'] === 'true') {
            $popupBg = 'bg-blue-400';
            $popupText = ($popupRowId !== null) 
                ? 'Task ' . $popupRowId . ' has been successfully updated!' 
                : 'Task updated, but the ID was lost. Please contact a systems administrator.';
        } else {
            $popupBg = 'bg-red-400';
            $popupText = 'Task update failed. Please contact a systems administrator.';
        }
    }

    if ( isset($_GET['delete-success']) ) {
        if ( $_GET['delete-success'] === 'true') {
            $popupBg = 'bg-blue-400';
            $popupText = ($popupRowId !== null) 
                ? 'Task ' . $popupRowId . ' has been successfully deleted.' 
                : 'Task deleted, but the ID was lost. Please contact a systems administrator.';
        } else {
            $popupBg = 'bg-red-400';
            $popupText = 'Task deletion failed. Please contact a systems administrator.';
        }
    }
    ?>

    <div id="popup" class="<?= $popupDisplay ?> <?= $popupBg ?> flex-row mt-6 px-8 py-6 rounded-xl items-center text-white">
        <div>
            {{ $popupText }}
        </div>
        <a id="popup-close" class="ml-auto px-6 py-3 rounded-xl bg-gray-500 hover:bg-gray-600 text-white font-bold cursor-pointer transition">
            Close
        </a>
    </div>
    
    <div id="tasks" class="flex flex-col w-full px-6 my-6 py-6 gap-6 rounded-xl bg-gray-200">
        <div class="hidden xl:flex flex-row w-full px-10 py-6 rounded-xl bg-gray-100 font-bold">
            <div class="w-full max-w-1/8 mr-4">
                Task Title
            </div>
            <div class="w-full max-w-2/6 mr-6">
                Task Description
            </div>
            <div class="w-full max-w-1/6 mr-4">
                Task Status
            </div>
            <div class="w-full max-w-1/6 mr-4">
                Task Due-Date
            </div>
            <div class="w-full max-w-2/8 ml-auto">
                Actions
            </div>
        </div>

        @foreach ( $tasks as $task )
            <div class="task-row flex flex-col xl:flex-row gap-8 xl:gap-0 items-start xl:items-center w-full px-10 py-6 rounded-xl bg-gray-100" task-id="{{ $task->getId() }}">
                <div class="w-full max-w-max xl:max-w-1/8 mr-4">
                    {{ $task->getTitle() }}
                </div>
                <div class="w-full max-w-max xl:max-w-2/6 mr-6">
                    {{ $task->getDescShort() }}
                </div>
                <div class="w-full max-w-max xl:max-w-1/6 mr-4">
                    {{ $task->getStatus() }}
                </div>
                <div class="w-full max-w-max xl:max-w-1/6 mr-4">
                    {{ $task->getDueDate() }}
                </div>
                <div class="flex flex-col lg:flex-row gap-2 w-full min-w-2/8 ml-0 xl:ml-auto">
                    <a class="task-view-btn inline-block min-h-[48px] px-6 py-3 rounded-xl bg-blue-400 hover:bg-blue-500 text-white font-bold cursor-pointer transition">
                        View
                    </a>
                    <a class="task-edit-btn inline-block min-h-[48px] px-6 py-3 rounded-xl bg-yellow-400 hover:bg-yellow-500 text-white font-bold cursor-pointer transition">
                        Edit
                    </a>
                    <a class="task-delete-btn inline-block min-h-[48px] px-6 py-3 rounded-xl bg-red-400 hover:bg-red-500 text-white font-bold cursor-pointer transition">
                        Delete
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal HTML -->
    <div id="modal" class="hidden absolute w-full h-full top-0 left-0">

        <div class="absolute h-full w-full top-0 left-0">
            <div id="modal-bg" class="absolute left-0 top-0 w-screen min-h-screen h-full w-full bg-black opacity-50">
            </div>
            <div id="modal-content" class="w-[80%] left-0 py-16 mx-auto">
            </div>
        </div>
        
    </div>
</body>

</html>