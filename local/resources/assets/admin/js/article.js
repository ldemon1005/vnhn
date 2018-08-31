$(document).ready(function(){
  var url = $('.currentUrl').text();
  

  $(document).on('click', '.btnOn', function(event) {
    var btnThis = $(this);
    var id = $(this).next().text();
    var btnNext = btnThis.parent().next().find('.btnDeni');
    console.log(btnNext.text());

    $.ajax({
      method: 'POST',
      url: url+'admin/articel/on',
      data: {
          '_token': $('meta[name="csrf-token"]').attr('content'),
          'id': id
      },
      success: function (resp) {
        btnThis.attr('class', 'btn btn-block btn-sm btn-success btnOff');
        btnThis.text('Đang chạy');

        btnNext.attr('class', 'btn btn-block btn-sm btn-default btnRun');
        btnNext.text('Đang chạy');

        btnThis.parent().next().next().find(".btnDelete").attr('style','display:none');
      },
      error: function () {
        console.log('Error');
      }
    });
  });

  $(document).on('click', '.btnOff', function(event) {
    var btnThis = $(this);
    var id = $(this).next().text();
    var btnNext = btnThis.parent().next().find('.btnRun');


    $.ajax({
      method: 'POST',
      url: url+'admin/articel/off',
      data: {
          '_token': $('meta[name="csrf-token"]').attr('content'),
          'id': id
      },
      success: function (resp) {
        btnThis.attr('class', 'btn btn-block btn-sm btn-default btnOn');
        btnThis.text('Không hoạt động');

        btnNext.attr('class', 'btn btn-block btn-sm btn-default btnDeni');
        btnNext.text('Dừng');

        btnThis.parent().next().next().find(".btnDelete").attr('style','display:block');
      },
      error: function () {
        console.log('Error');
      }
    });
  });

  $(document).on('click', '.btn1', function(event) {
    var btnThis = $(this);
    var id = $(this).siblings(".id_group").text();
    var btnPrev = btnThis.parent().prev().find('button');
    var btnNext = btnThis.next();
    console.log(id);
    $.ajax({
      method: 'POST',
      url: url+'admin/articel/status1',
      data: {
          '_token': $('meta[name="csrf-token"]').attr('content'),
          'id': id
      },
      success: function (resp) {
        btnThis.attr('class', 'btn btn-block btn-sm btn-default');
        btnThis.text('Đang chạy');

        btnNext.css('display', 'none');
        
        btnPrev.attr('class', 'btn btn-block btn-sm btn-success btnOff');
        btnPrev.text('Hoạt động');

      },
      error: function () {
        console.log('Error');
      }
    });
  });
  $(document).on('click', '.btn2', function(event) {
    var btnThis = $(this);
    var id = $(this).siblings(".id_group").text();
    var btnNext = btnThis.next();

    $.ajax({
      method: 'POST',
      url: url+'admin/articel/status2',
      data: {
          '_token': $('meta[name="csrf-token"]').attr('content'),
          'id': id
      },
      success: function (resp) {
        btnThis.attr('class', 'btn btn-block btn-sm btn-default ');
        btnThis.text('Đã gửi');

        btnNext.css('display', 'none');
      },
      error: function () {
        console.log('Error');
      }
    });
  });
  $(document).on('click', '.btn3', function(event) {
    var btnThis = $(this);
    var id = $(this).next().text();

    $.ajax({
      method: 'POST',
      url: url+'admin/articel/status3',
      data: {
          '_token': $('meta[name="csrf-token"]').attr('content'),
          'id': id
      },
      success: function (resp) {
        btnThis.attr('class', 'btn btn-block btn-sm btn-default');
        btnThis.text('Đã gửi');
      },
      error: function () {
        console.log('Error');
      }
    });
  });
  $(document).on('click', '.btn4', function(event) {
    var btnThis = $(this);
    var id = $(this).next().text();
    var btnPrev = btnThis.prev();
    var btnPrev2 = btnThis.parent().prev().find('button');
    $.ajax({
      method: 'POST',
      url: url+'admin/articel/status4',
      data: {
          '_token': $('meta[name="csrf-token"]').attr('content'),
          'id': id
      },
      success: function (resp) {
        btnThis.attr('class', 'btn btn-block btn-sm btn-default');
        btnThis.text('Đã gửi');

        btnPrev.css('display', 'none');
        btnPrev2.css('display', 'none');
      },
      error: function () {
        console.log('Error');
      }
    });
  });

  $(document).on('click', '.btnComment', function(event) {
    var btnThis = $(this);
    var id = $(this).next().text();
    var btnPrev = btnThis.prev();
    var btnPrev2 = btnThis.parent().prev().find('button');
    $.ajax({
      method: 'POST',
      url: url+'admin/articel/getComment',
      data: {
          '_token': $('meta[name="csrf-token"]').attr('content'),
          'id': id
      },
      success: function (resp) {
        $('#comment_return_view').find('.modal-body').text(resp);
        $('#comment_return_view').modal();
      },
      error: function () {
        console.log('Error');
      }
    });
  });

  $(document).on('click', '.btn_return', function(event) {
    var title = $(this).parent().siblings(".a_hover").children("a").text();
    var id = $(this).next().text();
    $("#comment_article").find('h5').text('(Trả lại) '+title);
    $("input[name='id_article']").val(id);
    $("#comment_article").modal('show');
  });
  $(document).on('click', 'button.btn_sbm_return_remote', function() {
    
    $("input[name='btn_sbm_return']").click();
  });



  $('.articleTimeBtnEdit').click(function(){
    $(this).prev().toggle();
    $(this).next().toggle();
    $(this).toggle();
  });

  $('.btn_send_time').click(function(){
    var btnThis = $(this);
    var id = $(this).next().text();
    var day = btnThis.parent().prev().find('input').val();
    var h = btnThis.prev().val();
    var btnEdit = $(this).parents('.articleTimeHide').siblings(".articleTimeBtnEdit");

    var new_day = $(this).parents('.articleTimeHide').siblings(".articleTimeShow").find('.articleTimeShowDay');
    var new_h = $(this).parents('.articleTimeHide').siblings(".articleTimeShow").find('.articleTimeShowH');
    $.ajax({
      method: 'POST',
      url: url+'admin/articel/set_time',
      data: {
          '_token': $('meta[name="csrf-token"]').attr('content'),
          'id': id,
          'day': day,
          'h': h
      },
      success: function (resp) {
        new_day.text(resp.day);
        new_h.text(resp.h);
        btnEdit.click();
        console.log(resp.day);
      },
      error: function () {
        console.log('Error');
      }
    });
  });
  $(document).on('change', '.choose_relate', function (e) {
    var group_id = $(this).val();

    e.preventDefault();
    $.ajax({
      method: 'POST',
      url: url+'admin/articel/get_relate',
      data: {
          '_token': $('meta[name="csrf-token"]').attr('content'),
          'groupid': group_id
      },
      success: function (resp) {
       if(resp){
            // console.log(resp);
            setTimeout(function () {
                $('#relate').html(resp);
                // $('#relate').selectpicker('refresh');
            },200);
        }

      },
      error: function () {
        console.log('error');
      }
    });


    // e.preventDefault();
    // $.ajax({
    //   method: 'POST',
    //   url: url+'admin/articel/group_child_from',
    //   data: {
    //       '_token': $('meta[name="csrf-token"]').attr('content'),
    //       'groupid': group_id
    //   },
    //   success: function (resp) {
    //    if(resp){
    //         console.log(resp);
    //         setTimeout(function () {
    //             $('#group_child').html(resp);
    //         },200);
    //     }

    //   },
    //   error: function () {
    //     console.log('error');
    //   }
    // });
  });
  $(document).on('change', '#group', function (e) {
    var group_id = $(this).val();
    $.ajax({
      method: 'POST',
      url: url+'admin/articel/group_child_from',
      data: {
          '_token': $('meta[name="csrf-token"]').attr('content'),
          'groupid': group_id
      },
      success: function (resp) {
       if(resp){
            console.log(resp);
            setTimeout(function () {
                $('#group_child').html(resp);
            },200);
        }

      },
      error: function () {
        console.log('error');
      }
    });
  });
  $(document).on('click', '.btnSend', function(event) {
    var btnThis = $(this);
    var id = $(this).next().text();
    $.ajax({
      method: 'POST',
      url: url+'admin/articel/send_article',
      data: {
          '_token': $('meta[name="csrf-token"]').attr('content'),
          'id': id
      },
      success: function (resp) {
        btnThis.attr('class', 'btn btn-block btn-sm btn-warning');
        btnThis.text('Chờ duyệt');
      },
      error: function () {
        console.log('Error');
      }
    });
  });
});