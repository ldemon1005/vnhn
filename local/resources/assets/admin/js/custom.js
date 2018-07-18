function historyVideo(video_id) {
    $.ajax({
        url: '/admin/video/history_video/'+video_id,
        method: 'get',
        dataType: 'json',
    }).fail(function (ui, status) {
    }).done(function (data, status) {
        $("#history_video").html(data.content);
        $("#history_video").modal('show');
    });
}

function change_status(video_id,status_video) {
    $('#status_video').addClass('disabled');
    $.ajax({
        url: '/admin/video/update_status/'+video_id,
        method: 'get',
        dataType: 'json',
    }).fail(function (ui, status) {
        $('#status_video').removeClass('disabled');
    }).done(function (data, status) {
        if(data.status == 1){
            console.log('đúng rồi mà');
            if(status_video == 0){
                var html = "<button onclick=\"change_status("+video_id+","+data.video_status+")\" class=\"btn btn-block btn-sm btn-success\">Đã duyệt</button>"
                $('#status_video').html(html);
            }else {
                var html = "<button onclick=\"change_status("+video_id+","+data.video_status+")\" class=\"btn btn-block btn-sm btn-danger\">Chưa duyệt</button>"
                $('#status_video').html(html);
            }

        }
        $('#status_video').removeClass('disabled');
    });
}