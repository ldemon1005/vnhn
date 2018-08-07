$(document).ready(function(){
  var url = $('.currentUrl').text();
  

  $(document).on('click', '.btnStatus', function(event) {
    var btnThis = $(this);
    var id = $(this).next().text();
    var status = parseInt($(this).attr('status'));
    var btnAround = $(this).siblings();
    var btnNext = btnThis.parent().next().find('.row a.btn-danger');
    
    
    $.ajax({
      method: 'POST',
      url: url+'admin/magazine/status',
      data: {
          '_token': $('meta[name="csrf-token"]').attr('content'),
          'id': id,
          'status': status
      },
      success: function (resp) {
        switch(status){
          case 0:
            btnThis.attr('class', 'btn btn-block btn-sm btn-danger btnStatus');
            btnThis.attr('status', '1');
            btnThis.text('Dừng');

            btnNext.attr('style', 'display: block');
            break;
          case 1:
            btnThis.attr('class', 'btn btn-block btn-sm btn-default btnStatus');
            btnThis.attr('status', '0');
            btnThis.text('Đang chạy');

            btnAround.attr('style', 'display: none');

            btnNext.attr('style', 'display: none');
            break;
          case 2:
            btnThis.attr('class', 'btn btn-block btn-sm btn-default');
            btnThis.attr('status', '0');
            btnThis.text('Đã gửi');

            btnAround.attr('style', 'display: none');

            btnNext.attr('style', 'display: none');
            break;
          case 3:
            btnThis.attr('class', 'btn btn-block btn-sm btn-default');
            btnThis.attr('status', '0');
            btnThis.text('Trả lại');

            btnAround.attr('style', 'display: none');

            btnNext.attr('style', 'display: none');
            break;
          default:
            alert('Lỗi');
            break;
        }
        
      },
      error: function () {
        alert('Error');
      }
    });
  });
});