import flatpickr from 'flatpickr';
import $ from 'jquery';
import "../../node_modules/flatpickr/dist/flatpickr.css";

$(document).ready(function () {

    /*****************************************
     * HEADER ROW EVENTS
     *****************************************/
    /**
     * Header Row Create Button
     */
    $('#action-header').on('click', '#task-create-btn', function() {
        $.ajax({
            type:'POST',
            url:'/tasks/view-task',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'mode': "*CREATE",
                'id': null
            },
            success:function(data) {
                $('#modal-content').html(data.html);
                const FP_DUED = flatpickr('#CREATE_TASK10_DUED', {});
                $('#modal').show();
            }
        });
    });

    /*****************************************
     * TASK ROW EVENTS
     *****************************************/
    /**
     * Task Row View Button
     */
    $('#tasks').on('click', '.task-view-btn', function() {
        var taskId = $(this).closest('.task-row').attr('task-id');
        $.ajax({
            type:'POST',
            url:'/tasks/view-task',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'mode': "*VIEW",
                'TASK10_ID': taskId
            },
            success:function(data) {
                $('#modal-content').html(data.html);
                $('#modal').show();
            }
        });
    });

    /**
     * Task Row Edit Button
     */
    $('#tasks').on('click', '.task-edit-btn', function() {
        var taskId = $(this).closest('.task-row').attr('task-id');
        $.ajax({
            type:'POST',
            url:'/tasks/view-task',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'mode': "*EDIT",
                'TASK10_ID': taskId
            },
            success:function(data) {
                $('#modal-content').html(data.html);
                const FP_DUED = flatpickr('#EDIT_TASK10_DUED', {});
                $('#modal').show();
            }
        });
    });

    /**
     * Task Row Delete Button
     */
    $('#tasks').on('click', '.task-delete-btn', function() {
        var taskId = $(this).closest('.task-row').attr('task-id');
        $.ajax({
            type:'POST',
            url:'/tasks/warning-task',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'TASK10_ID': taskId
            },
            success:function(data) {
                $('#modal-content').html(data.html);
                $('#modal').show();
            }
        });
    });

    /*****************************************
     * MODAL EVENTS
     *****************************************/
    /**
     * Modal Create Mode Save Button
     */
    $('#modal').on('click', '#modal-create-save', function() {
        var TASK10_TITL = $('#modal #CREATE_TASK10_TITL').val();
        var TASK10_DESC = $('#modal #CREATE_TASK10_DESC').val();
        var TASK10_STUS = $('#modal #CREATE_TASK10_STUS').val();
        var TASK10_DUED = $('#modal #CREATE_TASK10_DUED').val();
        $.ajax({
            type:'POST',
            url:'/tasks/create-task',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'TASK10_TITL': TASK10_TITL,
                'TASK10_DESC': TASK10_DESC,
                'TASK10_STUS': TASK10_STUS,
                'TASK10_DUED': TASK10_DUED
            },
            success:function(data) {
                window.location.href = "?create-success=true";
            },
            error:function(xhr, status, error) {
                window.location.href = "?create-success=false";
            }
        });
    });

    /**
     * Modal Edit Mode Save Button
     */
    $('#modal').on('click', '#modal-edit-save', function() {
        var TASK10_ID = $('#modal #modal-task-id').attr('task-id');
        var TASK10_TITL = $('#modal #EDIT_TASK10_TITL').val();
        var TASK10_DESC = $('#modal #EDIT_TASK10_DESC').val();
        var TASK10_STUS = $('#modal #EDIT_TASK10_STUS').val();
        var TASK10_DUED = $('#modal #EDIT_TASK10_DUED').val();
        $.ajax({
            type:'POST',
            url:'/tasks/update-task',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'TASK10_ID': TASK10_ID,
                'TASK10_TITL': TASK10_TITL,
                'TASK10_DESC': TASK10_DESC,
                'TASK10_STUS': TASK10_STUS,
                'TASK10_DUED': TASK10_DUED
            },
            success:function(data) {
                window.location.href = "?edit-success=true&id=" + TASK10_ID;
            },
            error:function(xhr, status, error) {
                window.location.href = "?edit-success=false&id=" + TASK10_ID;
            }
        });
    });

    /**
     * Modal Warning Mode Delete Button
     */
    $('#modal').on('click', '#modal-delete', function() {
        var TASK10_ID = $('#modal #modal-task-id').attr('task-id');
        $.ajax({
            type:'POST',
            url:'/tasks/delete-task',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'TASK10_ID': TASK10_ID
            },
            success:function(data) {
                window.location.href = "?delete-success=true&id=" + TASK10_ID;
            },
            error:function(xhr, status, error) {
                window.location.href = "?delete-success=false&id=" + TASK10_ID;
            }
        });
    });

    /**
     * Modal Close Button & Background
     */
    $('#modal').on('click', '#modal-bg,#modal-close', function() {
        $('#modal').hide();
    });
    
    /*****************************************
     * POPUP EVENTS
     *****************************************/
    /**
     * Popup Close Button
     */
    $('#popup').on('click', '#popup-close', function() {
        $('#popup').hide();
    });

});