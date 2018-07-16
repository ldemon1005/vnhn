<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <base href="{{ asset('local/resources/assets/admin') }}/">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="shortcut icon" href="http://vietnamhoinhap.vn/images/favicon.ico" />
  <title>VNHN | @yield('title')</title>
  <link rel="stylesheet" type="text/css" href="../css/all.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  @include('admin.layouts.header')
  <!-- Navbar -->
  
  @include('admin.layouts.aside')
  @yield('main')

  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @include('admin.layouts.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
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
      });



  </script>
</body>
</html>
