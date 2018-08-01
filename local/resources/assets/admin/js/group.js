$(document).ready(function(){
  var url = $('.currentUrl').text();
  $(document).on('click', '.btnOn', function(event) {
    var btnThis = $(this);
    var id = $(this).next().text();
    $.ajax({
      method: 'POST',
      url: url+'admin/group/on',
      data: {
          '_token': $('meta[name="csrf-token"]').attr('content'),
          'id': id
      },
      success: function (resp) {
        btnThis.attr('class', 'btn btn-block btn-sm btn-success btnOff');
        btnThis.text(' Hoạt động');
      },
      error: function () {
        alert('Error');
      }
    });
  });

  $(document).on('click', '.btnOff', function(event) {
    var btnThis = $(this);
    var id = $(this).next().text();
    $.ajax({
      method: 'POST',
      url: url+'admin/group/off',
      data: {
          '_token': $('meta[name="csrf-token"]').attr('content'),
          'id': id
      },
      success: function (resp) {
        btnThis.attr('class', 'btn btn-block btn-sm btn-danger btnOn');
        btnThis.text('Không hoạt động');
      },
      error: function () {
        alert('Error');
      }
    });
  });
});