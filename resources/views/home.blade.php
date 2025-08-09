<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" /> @vite('resources/css/app.css')
</head>

<body class="m-16 bg-white">
    
    <div class="flex flex-row gap-6">
        <div class="px-10 py-6 rounded-xl bg-gray-200">
            <h1 class="text-4xl font-bold whitespace-nowrap">Tasks Demo for DTS</h1>
        </div>
        <div class="w-full px-10 py-6 rounded-xl bg-gray-200">
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
            <div class="w-full max-w-1/6 ml-auto">
                Actions
            </div>
        </div>
        @foreach ( $tasks as $task )
            <div class="flex flex-row w-full px-10 my-6 py-6 rounded-xl bg-gray-100">
                <div class="w-full max-w-1/6">
                    {{ $task->TASK10_TITL }}
                </div>
                <div class="w-full max-w-1/6">
                    {{ $task->TASK10_DESC }}
                </div>
                <div class="w-full max-w-1/6">
                    {{ $task->TASK10_STUS }}
                </div>
                <div class="w-full max-w-1/6">
                    {{ $task->TASK10_DUED }}
                </div>
                <div class="w-full max-w-1/6 ml-auto">
                    <a class="px-6 py-3 rounded-xl bg-red-400 hover:bg-red-500 text-white font-bold cursor-pointer transition">
                        Delete
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</body>

</html>