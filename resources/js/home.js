import flatpickr from 'flatpickr';
import $ from 'jquery';
import "../../node_modules/flatpickr/dist/flatpickr.css";

$(document).ready(function () {

    $('.task-view-btn').click( function() {
        var taskId = $(this).closest('.task-row').attr('task-id');
        $.ajax({
            type:'POST',
            url:'/tasks/viewTask',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'mode': "*VIEW",
                'id': taskId
            },
            success:function(data) {
                $('#modal-content').html(data.html);
                $('#modal').show();
            }
        });
    });

    $('.task-edit-btn').click( function() {
        var taskId = $(this).closest('.task-row').attr('task-id');
        $.ajax({
            type:'POST',
            url:'/tasks/viewTask',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'mode': "*EDIT",
                'id': taskId
            },
            success:function(data) {
                $('#modal-content').html(data.html);

                const FP_DUED = flatpickr('#EDIT_TASK10_DUED', {});
                const FP_LUPD = flatpickr('#EDIT_TASK10_LUPD', {});
                const FP_CRTD = flatpickr('#EDIT_TASK10_CRTD', {});

                $('#modal').show();
            }
        });
    });

    $('#modal').on('click', '#modal-bg,#modal-close', function() {
        $('#modal').hide();
    });

});