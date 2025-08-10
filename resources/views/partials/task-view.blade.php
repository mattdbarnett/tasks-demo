<?php
use App\Models\Mode;
?>

<div class="relative p-8 w-full h-full bg-white z-10 rounded-xl">
    <div id="modal-task-id" task-id="<?= $task->getId() ?>"></div>
    <div class="flex flex-row gap-6">
        <div class="flex items-center px-10 py-6 rounded-xl bg-gray-200">
            <h1 class="text-4xl font-bold whitespace-nowrap">
                {{ $title }}
            </h1>
        </div>
        <div class="flex item-center w-full px-8 py-6 rounded-xl bg-gray-100">
            <?php
            /**
             * Action Buttons
             */
            switch($mode) {
                case Mode::EDIT_MODE: { ?>
                    <a id="modal-save" class="px-6 py-3 rounded-xl bg-green-400 hover:bg-green-500 text-white font-bold cursor-pointer transition">
                        Save
                    </a>
                <?php } break; 
            } ?>
            <a id="modal-close" class="ml-auto px-6 py-3 rounded-xl bg-gray-400 hover:bg-gray-500 text-white font-bold cursor-pointer transition">
                Close
            </a>
        </div>
    </div>

    <?php 
    /**
     * Main Content
     */
    switch($mode) {
        case Mode::VIEW_MODE: { ?>
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
        <?php } break;
        case Mode::EDIT_MODE: { 
            $statusValue = $task->getStatusValue(); ?>
            <div class="flex flex-col gap-6 w-full p-6 mt-8 rounded-xl bg-gray-200">
                <div class="flex flex-row items-center w-full px-10 py-6 rounded-xl bg-gray-100">
                    <span class="font-bold min-w-1/6 mr-4">Task Title:</span>
                    <input 
                        class="bg-white w-1/2 py-1 px-3 rounded-lg text-md" 
                        type="text" 
                        name="TASK10_TITL"
                        value="<?= $task->getTitle() ?>"
                    />
                </div>
                <div class="flex flex-row items-center w-full px-10 py-6 rounded-xl bg-gray-100">
                    <span class="font-bold min-w-1/6 mr-4">Task Description:</span>
                    <textarea class="w-full bg-white py-1 px-3 rounded-lg text-md" name="TASK10_DESC"><?= $task->getDesc() ?></textarea>
                </div>
                <div class="flex flex-row items-center w-full px-10 py-6 rounded-xl bg-gray-100">
                    <span class="font-bold min-w-1/6 mr-4">Task Status:</span>
                    <select class="bg-white py-1 px-3 rounded-lg text-md" name="TASK10_STUS">
                        <option value="0" <?= ($statusValue == "0") ? 'selected="selected"' : ''?>>Incomplete</option>
                        <option value="1" <?= ($statusValue == "1") ? 'selected="selected"' : ''?>>In Progress</option>
                        <option value="2" <?= ($statusValue == "2") ? 'selected="selected"' : ''?>>Complete</option>
                    </select>
                </div>
                <div class="flex flex-row items-center w-full px-10 py-6 rounded-xl bg-gray-100">
                    <span class="font-bold min-w-1/6 mr-4">Task Due Date:</span>
                    <input 
                        class="bg-white w-1/2 py-1 px-3 rounded-lg text-md" 
                        type="text" 
                        id="EDIT_TASK10_DUED"
                        name="TASK10_DUED"
                        value="<?= $task->getDueDate() ?>"
                    />
                </div>
                <div class="flex flex-row items-center w-full px-10 py-6 rounded-xl bg-gray-100">
                    <span class="font-bold min-w-1/6 mr-4">Modified Date:</span>
                    <input 
                        class="bg-white w-1/2 py-1 px-3 rounded-lg text-md" 
                        type="text" 
                        id="EDIT_TASK10_LUPD"
                        name="TASK10_LUPD"
                        value="<?= $task->getModifiedDate() ?>"
                    />
                </div>
                <div class="flex flex-row items-center w-full px-10 py-6 rounded-xl bg-gray-100">
                    <span class="font-bold min-w-1/6 mr-4">Created Date:</span>
                    <input 
                        class="bg-white w-1/2 py-1 px-3 rounded-lg text-md" 
                        type="text" 
                        id="EDIT_TASK10_CRTD"
                        name="TASK10_CRTD"
                        value="<?= $task->getCreatedDate() ?>"
                    />
                </div>
            </div>
        <?php } break; ?>
    <?php } ?>
</div>