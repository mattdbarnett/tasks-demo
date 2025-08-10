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

<body class="m-16 bg-white">
    
    <div class="flex flex-row gap-6">
        <div class="flex items-center px-10 py-6 rounded-xl bg-gray-200">
            <h1 class="text-4xl font-bold whitespace-nowrap">Tasks Demo for DTS</h1>
        </div>
        <div class="flex item-center w-full px-8 py-6 rounded-xl bg-gray-100">
            <a class="px-6 py-3 mr-2 rounded-xl bg-green-400 hover:bg-green-500 text-white font-bold cursor-pointer transition">
                Create a Task
            </a>
            <a class="px-6 py-3 mr-2 rounded-xl bg-gray-400 hover:bg-gray-500 text-white font-bold cursor-pointer transition">
                Dump Tasks
            </a>
            <a class="px-6 py-3 rounded-xl bg-red-400 hover:bg-red-500 text-white font-bold cursor-pointer transition">
                Delete All
            </a>
        </div>
    </div>
    
    <div class="w-full px-10 my-6 py-6 rounded-xl bg-gray-200">
        <div class="flex flex-row w-full px-10 my-6 py-6 rounded-xl bg-gray-100 font-bold">
            <div class="w-full max-w-1/6">
                Task Title
            </div>
            <div class="w-full max-w-1/6">
                Task Description
            </div>
            <div class="w-full max-w-1/6">
                Task Status
            </div>
            <div class="w-full max-w-1/6">
                Task Due-Date
            </div>
            <div class="w-full max-w-2/8 ml-auto">
                Actions
            </div>
        </div>

        @foreach ( $tasks as $task )
            <div class="task-row flex flex-row w-full px-10 my-6 py-6 rounded-xl bg-gray-100" row-id="{{ $task->getId() }}">
                <div class="w-full max-w-1/6">
                    {{ $task->getTitle() }}
                </div>
                <div class="w-full max-w-1/6">
                    {{ $task->getDesc() }}
                </div>
                <div class="w-full max-w-1/6">
                    {{ $task->getStatus() }}
                </div>
                <div class="w-full max-w-1/6">
                    {{ $task->getDueDate() }}
                </div>
                <div class="w-full max-w-2/8 ml-auto">
                    <a class="task-view-btn px-6 py-3 mr-2 rounded-xl bg-blue-400 hover:bg-blue-500 text-white font-bold cursor-pointer transition">
                        View
                    </a>
                    <a class="task-edit-btn px-6 py-3 mr-2 rounded-xl bg-yellow-400 hover:bg-yellow-500 text-white font-bold cursor-pointer transition">
                        Edit
                    </a>
                    <a class="task-delete-btn px-6 py-3 mr-2 rounded-xl bg-red-400 hover:bg-red-500 text-white font-bold cursor-pointer transition">
                        Delete
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal HTML -->
    <div id="modal" class="hidden absolute w-full h-full top-0 left-0">

        <div id="modal-bg" class="w-screen h-full bg-black opacity-50">
        </div>

        <div id="modal-content" class="absolute w-screen px-64 py-16 top-0 left-0">
        </div>
        
    </div>
</body>

</html>