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
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <link rel="stylesheet" type="text/css" href="css/aside.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  @yield('css')
</head>
<body class="hold-transition sidebar-mini">
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
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<script src="js/uploadImage.js"></script>

<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>

<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>

<!-- OPTIONAL SCRIPTS -->

<script>
//    $(function () {
//        CKEDITOR.replace( 'editor1', {
//            filebrowserBrowseUrl: 'manage/source/bower_components/ckfinder/ckfinder.html',
//            filebrowserImageBrowseUrl: 'manage/source/bower_components/ckfinder/ckfinder.html?type=Images',
//            filebrowserFlashBrowseUrl: 'manage/source/bower_components/ckfinder/ckfinder.html?type=Flash',
//            filebrowserUploadUrl: 'manage/source/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
//            filebrowserImageUploadUrl: 'manage/source/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
//            filebrowserFlashUploadUrl: 'manage/source/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
//        } );
//    })
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
</body>
</html>
