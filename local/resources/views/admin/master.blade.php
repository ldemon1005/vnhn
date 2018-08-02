<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <base href="{{ asset('local/resources/assets/admin') }}/">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="shortcut icon" href="http://vietnamhoinhap.vn/images/favicon.ico" />
  <title>VNHN | @yield('title')</title>

  <link rel="stylesheet" type="text/css" href="../css/all.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">

  <link rel="stylesheet" href="plugins/select2/select2.min.css">

  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">

  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <link rel="stylesheet" type="text/css" href="css/aside.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/master.css">
  @yield('css')
</head>
<body class="hold-transition sidebar-mini">
<div class="currentUrl" style="display: none;">
  {{ asset('') }}
</div>
<div class="errorAlert">
  @include('errors.note')
</div>
<div class="wrapper">

  @include('admin.layouts.header')
  <!-- Navbar -->
  
  @include('admin.layouts.sidebar')
  @yield('main')

  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @include('admin.layouts.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<script src="js/uploadImage.js"></script>
<script src="js/jquery.validate.min.js"></script>

<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>

<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>

{{--<script src="dist/js/pages/dashboard.js"></script>--}}

<script src="dist/js/adminlte.js"></script>

<script src="plugins/bootstrap/js/bootstrap.js"></script>

<script src="js/custom.js"></script>
<script src="dist/js/adminlte.js"></script>


<!-- OPTIONAL SCRIPTS -->

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();

        $('.timepicker').timepicker({
            showInputs: false
        })
    });

</script>
@yield('script')

<script type="text/javascript">
  function changeImg(input){
    var inputFile = $(this);

    console.log($(input).next());
        //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
      if(input.files && input.files[0]){
          var reader = new FileReader();
          //Sự kiện file đã được load vào website
          reader.onload = function(e){
              //Thay đổi đường dẫn ảnh
              // $('#avatar').attr('src',e.target.result);
              $(input).next().attr('src',e.target.result);

          }
          reader.readAsDataURL(input.files[0]);
      }
  }
  $(document).ready(function() {
    // $('#avatar').click(function(){
    //     $(this).prev().click();
    // });
    $('.cssInput').click(function(){
      $(this).prev().click();
    })
    $('.errorAlert').css('bottom','100px');
    setTimeout(function(){
      $('.errorAlert').css('bottom', '-200px');
    }, 3000);
    setTimeout(function(){
      $('.errorAlert').fadeOut();
    }, 3900);
    localStorage.setItem('username', '{{Auth::user()->username}}');
  });

  </script>
</body>
</html>
