$(document).ready(function(){
  var url = $('.currentUrl').text();
  $(document).on('click', '.btnOn', function(event) {
    var btnThis = $(this);
    var id = $(this).next().text();
    var btnRemove = $(this).parent().next().find('.row a.text-danger');

    $.ajax({
      method: 'POST',
      url: url+'admin/group_video/on',
      data: {
          '_token': $('meta[name="csrf-token"]').attr('content'),
          'id': id
      },
      success: function (resp) {
        btnThis.attr('class', 'btn btn-block btn-sm btn-success btnOff');
        btnThis.text(' Hoạt động');

        btnRemove.attr('style', 'display: none');
      },
      error: function () {
        console.log('Lỗi server');
      }
    });
  });

  $(document).on('click', '.btnOff', function(event) {
    var btnThis = $(this);
    var id = $(this).next().text();
    var btnRemove = $(this).parent().next().find('.row a.text-danger');
    $.ajax({
      method: 'POST',
      url: url+'admin/group_video/off',
      data: {
          '_token': $('meta[name="csrf-token"]').attr('content'),
          'id': id
      },
      success: function (resp) {
        btnThis.attr('class', 'btn btn-block btn-sm btn-danger btnOn');
        btnThis.text('Không hoạt động');
        
        btnRemove.attr('style', 'display: block');
      },
      error: function () {
        console.log('Lỗi server');
      }
    });
  });
});