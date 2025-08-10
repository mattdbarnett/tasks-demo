

<div class="relative p-8 w-full h-full bg-white z-10 rounded-xl">
    <div class="flex flex-row gap-6">
        <div class="flex items-center px-10 py-6 rounded-xl bg-gray-200">
            <h1 class="text-4xl font-bold whitespace-nowrap">
                {{ $title }}
            </h1>
        </div>
        <div class="flex item-center w-full px-8 py-6 rounded-xl bg-gray-100">
        </div>
    </div>
    <div class="flex flex-col gap-6 w-full p-6 mt-8 rounded-xl bg-gray-200">
        <div class="flex flex-row w-full px-10 py-6 rounded-xl bg-gray-100">
            <span class="font-bold min-w-1/6 mr-4">Task Title:</span>
            <span> {{ $task->getTitle() }} </span>
        </div>
        <div class="flex flex-row w-full px-10 py-6 rounded-xl bg-gray-100">
            <span class="font-bold min-w-1/6 mr-4">Task Description:</span>
            <span> {{ $task->getDesc() }} </span>
        </div>
        <div class="flex flex-row w-full px-10 py-6 rounded-xl bg-gray-100">
            <span class="font-bold min-w-1/6 mr-4">Task Status:</span>
            <span> {{ $task->getStatus() }} </span>
        </div>
        <div class="flex flex-row w-full px-10 py-6 rounded-xl bg-gray-100">
            <span class="font-bold min-w-1/6 mr-4">Task Due Date:</span>
            <span> {{ $task->getDueDate() }} </span>
        </div>
        <div class="flex flex-row w-full px-10 py-6 rounded-xl bg-gray-100">
            <span class="font-bold min-w-1/6 mr-4">Modified Date:</span>
            <span> {{ $task->getModifiedDate() }} </span>
        </div>
        <div class="flex flex-row w-full px-10 py-6 rounded-xl bg-gray-100">
            <span class="font-bold min-w-1/6 mr-4">Created Date:</span>
            <span> {{ $task->getCreatedDate() }} </span>
        </div>
    </div>
</div>