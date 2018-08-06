$(document).ready(function(){
    var url = $('.currentUrl').text();
    $(document).on('click', '.btn_status', function(event) {
        var btnThis = $(this);
        var btnNext = btnThis.parent().next().find('.text-danger');
        var id = btnThis.next().text();

        
        $.ajax({    
            url: url+'/admin/comment/update_comment/'+id,
            method: 'get',
            dataType: 'json',
        }).fail(function (ui, status) {
            aler('Error');
            // $('#cm-status').removeClass('disabled');
        }).done(function (data, status) {
            if(data.data == 0){

                btnThis.attr('class', 'btn btn-block btn-sm btn-danger btn_status');
                btnThis.text('Chưa duyệt');

                btnNext.attr('style', 'display: block');
                
            }else {
                btnThis.attr('class', 'btn btn-block btn-sm btn-success btn_status');
                btnThis.text('Đã duyệt');

                btnNext.attr('style', 'display: none');
                
            }
            
        });
    });
});
