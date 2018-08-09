$(document).ready(function(){
  var url = $('.currentUrl').text();
  

  $(document).on('click', '.btnDetail', function(event) {
    var btnThis = $(this);
    var id = $(this).next().text();
    $.ajax({
      method: 'POST',
      url: url+'admin/contact/contact',
      data: {
          '_token': $('meta[name="csrf-token"]').attr('content'),
          'id': id
      },
      success: function (resp) {
        $('#exampleModal').find('h5').text(resp.name);
        $('#exampleModal').find('.modalName').text(resp.name);
        $('#exampleModal').find('.modalPhone').text(resp.phone);
        $('#exampleModal').find('.modalEmail').text(resp.email);
        $('#exampleModal').find('.modalAddress').text(resp.city);
        $('#exampleModal').find('.modalNo').text(resp.company);
        $('#exampleModal').find('.modalAmount').text(resp.type);
        $('#exampleModal').find('.modalContent').text(resp.content);

        $('#exampleModal').modal();
      },
      error: function () {
        
      }
    });
  });
});