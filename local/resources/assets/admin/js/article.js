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
        btnThis.text('Hoạt động');

        btnNext.attr('class', 'btn btn-block btn-sm btn-default btnRun');
        btnNext.text('Đang chạy');

        btnThis.parent().next().next().find(".btnDelete").attr('style','display:none');
      },
      error: function () {
        alert('Error');
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
        btnThis.attr('class', 'btn btn-block btn-sm btn-danger btnOn');
        btnThis.text('Không hoạt động');

        btnNext.attr('class', 'btn btn-block btn-sm btn-default btnDeni');
        btnNext.text('Dừng');

        btnThis.parent().next().next().find(".btnDelete").attr('style','display:block');
      },
      error: function () {
        alert('Error');
      }
    });
  });

  $(document).on('click', '.btn1', function(event) {
    var btnThis = $(this);
    var id = $(this).next().next().text();
    var btnPrev = btnThis.parent().prev().find('button');
    var btnNext = btnThis.next();

    $.ajax({
      method: 'POST',
      url: url+'admin/articel/on',
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
        alert('Error');
      }
    });
  });
  $(document).on('click', '.btn2', function(event) {
    var btnThis = $(this);
    var id = $(this).next().next().text();
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
        alert('Error');
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
        alert('Error');
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
      url: url+'admin/articel/status3',
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
        alert('Error');
      }
    });
  });
});