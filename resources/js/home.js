import $ from 'jquery';

$(document).ready(function () {

    $('.task-view-btn').click( function() {
        var taskId = $(this).closest('.task-row').attr('row-id');
        $.ajax({
            type:'POST',
            url:'/tasks/getTaskById',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'id': taskId
            },
            success:function(data) {
                $('#modal-content').html(data.html);
                $('#modal').show();
            }
        });
    });

    $('#modal-bg').click( function() {
        $('#modal').hide();
    });

});