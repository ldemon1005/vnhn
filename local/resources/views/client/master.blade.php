<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <base href="{{ asset('local/resources/assets/') }}/">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Meta facebook -->
    @if(isset($articel_detail))
        <meta property="og:url"           content="{{ route('get_detail_articel',$articel_detail->slug.'---n-'.$articel_detail->id) }}" />
    @else
        <meta property="og:url"           content="{{ URL::current() }}" />
    @endif
        <meta property="og:type"          content="article" />
        <meta property="og:title"         content="@yield('fb_title')" />
        <meta property="og:description"   content="@yield('fb_des')" />
        <meta property="og:image"         content="@yield('fb_img')" />
        <meta property="og:image:width" content="400" />
        <meta property="og:image:height" content="300" />

    

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="shortcut icon" href="images/icon.png" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,700|Open+Sans:400,400i,600,600i,700,700i&amp;subset=vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="css/all.css">
{{--     <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css"> --}}
    <link rel="stylesheet" href="admin/plugins/select2/select2.min.css">



    @yield('css')
    <!-- Styles -->


    {{-- Google Analytics --}}

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-124412735-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-124412735-1');
    </script>

</head>
<body>
    <div class="currentUrl" style="display: none;">{{ asset('') }}</div>
  @include('client.layouts.header')
  @yield('main')
  @include('client.layouts.footer')
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
{{-- <script src="js/owl.carousel.min.js"></script> --}}
<script src="js/jquery.validate.min.js"></script>
<script src="js/custom.js"></script>
<script type="text/javascript" src="js/header-footer.js"></script>

<script src="https://apis.google.com/js/platform.js"></script>

<!-- Select2 -->
<script src="admin/plugins/select2/select2.full.min.js"></script>

{{-- <script type="text/javascript" src="js/bootstrap-select.min.js"></script> --}}

<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.1';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();
    });
</script>
<script type="text/javascript">
$(document).ready(function(){
    

    var menuHide = $('#header-menu .menu-header>li.menu_head_hide');
    var menuShow = $('#header-menu .menu-header>li.menuHeaderItem');
    var menudropdown = $('.dropdown_child li');


    $('#header_btnMenu').click(function(){
        // $('#header-menu .menu-header').css('top', '0');
        $('#header-menu .menu-header').children("li:first-child").find('a').text('{{ \Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Trang chủ' : 'Home'}}');
        $('#header-menu .menu-header').show();
        // setTimeout(function(){
        //  $('#header-menu .menu-header').find("li").css('margin-left', '0');
        //  $('.btn_close_menu').css('right', '20%');
        // },500);

    });
    $('.btn_close_menu').click(function(){
        $('#header-menu .menu-header').hide();
        // $('#header-menu .menu-header').find("li").css('margin-left', '-80%');
        // $('.btn_close_menu').css('right', '100%');
        // setTimeout(function(){
        //  $('#header-menu .menu-header').css('top', '-100%');
        // },500);


    });


    $('.btnCloseMobiFooter').click(function(){
        $('.bannerMobiFooter').css('display', 'none');
    });
    var count1 = 2;
    $('.menuHeaderItem .btn_dropdown_menu_head').click(function(){
        $(this).prev().slideToggle();
        // count1 % 2 ? $(this).css('transform',' rotate(0deg)') :  $(this).css('transform',' rotate(180deg)');
        // count1++;
    });
    $('.dropdown').click(function(){
        $(this).find('.dropdown_child').slideToggle();
        // count1 % 2 ? $(this).css('transform',' rotate(0deg)') :  $(this).css('transform',' rotate(180deg)');
        // count1++;
    });
    
    $(window).resize(function(){
        if ($(window).width() > 1200) {
            for(var i = 0; i < menuShow.length ; i++){
                if(i > {{ \Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 8 : 6}}){
                    menuShow.eq(i).attr('class', 'menuHeaderItem  menu_head_hide');
                }else{
                    menuShow.eq(i).attr('class', 'menuHeaderItem');
                }
            }
            for(var i = 0; i < menudropdown.length ; i++){
                if(i < {{ \Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 3 : 1}}){
                    menudropdown.eq(i).css('display', 'none');
                }else{
                    menudropdown.eq(i).css('display', 'block');
                }
            }
        }
        else if ($(window).width() > 992) {
            for(var i = 0; i < menuShow.length ; i++){
                if(i > {{ \Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 7 : 5}}){
                    menuShow.eq(i).attr('class', 'menuHeaderItem  menu_head_hide');
                }else{
                    menuShow.eq(i).attr('class', 'menuHeaderItem');
                }
            }
            for(var i = 0; i < menudropdown.length ; i++){
                if(i < 2){
                    menudropdown.eq(i).css('display', 'none');
                }else{
                    menudropdown.eq(i).css('display', 'block');
                }
            }
        }
        else if ($(window).width() > 768) {
            for(var i = 0; i < menuShow.length ; i++){
                if(i > {{ \Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 5 : 3}}){
                    menuShow.eq(i).attr('class', 'menuHeaderItem  menu_head_hide');
                }else{
                    menuShow.eq(i).attr('class', 'menuHeaderItem');
                }
            }
            for(var i = 0; i < menudropdown.length ; i++){
                if(i < 0){
                    menudropdown.eq(i).css('display', 'none');
                }else{
                    menudropdown.eq(i).css('display', 'block');
                }
            }
            // $('#header-menu .menu-header').css('top', '0');
            $('#header-menu .menu-header').children("li:first-child").html('<a href="{{ asset("") }}"><i class="fas fa-home"></i></a>');
            $('#header-menu .menu-header').css('display', 'flex');
            $('#header-menu .menu-header').show();
            
            // $('#header-menu .menu-header').find("li").css('margin-left', '0');
            // $('.btn_close_menu').css('right', '20%');
        }else{
            
            $('#header-menu .menu-header').css('display', 'block');
            $('#header-menu .menu-header').hide();
            // $('#header-menu .menu-header').find("li").css('margin-left', '-80%');
            // $('.btn_close_menu').css('right', '100%');
            // $('#header-menu .menu-header').css('top', '-100%');
        }
        
    });
    if ($(window).width() > 1200) {
        for(var i = 0; i < menuShow.length ; i++){
            if(i > {{ \Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 8 : 6}}){
                menuShow.eq(i).attr('class', 'menuHeaderItem  menu_head_hide');
            }else{
                menuShow.eq(i).attr('class', 'menuHeaderItem');
            }
        }
        for(var i = 0; i < menudropdown.length ; i++){
            if(i < {{ \Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 3 : 1}}){
                menudropdown.eq(i).css('display', 'none');
            }else{
                menudropdown.eq(i).css('display', 'block');
            }
        }
    }
    else if ($(window).width() > 992) {
        for(var i = 0; i < menuShow.length ; i++){
            if(i > {{ \Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 7 : 5}}){
                menuShow.eq(i).attr('class', 'menuHeaderItem  menu_head_hide');
            }else{
                menuShow.eq(i).attr('class', 'menuHeaderItem');
            }
        }
        for(var i = 0; i < menudropdown.length ; i++){
            if(i < 2){
                menudropdown.eq(i).css('display', 'none');
            }else{
                menudropdown.eq(i).css('display', 'block');
            }
        }
    }
    else if ($(window).width() > 768) {
        for(var i = 0; i < menuShow.length ; i++){
            if(i > {{ \Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 5 : 3}}){
                menuShow.eq(i).attr('class', 'menuHeaderItem  menu_head_hide');
            }else{
                menuShow.eq(i).attr('class', 'menuHeaderItem');
            }
        }
        for(var i = 0; i < menudropdown.length ; i++){
            if(i < 0){
                menudropdown.eq(i).css('display', 'none');
            }else{
                menudropdown.eq(i).css('display', 'block');
            }
        }
    }
});

</script>
@yield('script')
</html>
