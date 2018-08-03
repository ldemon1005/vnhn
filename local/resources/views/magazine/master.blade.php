<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <base href="{{ asset('local/resources/assets/') }}/">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>@yield('title')</title>
    <link rel="shortcut icon" href="http://vietnamhoinhap.vn/images/favicon.ico" />
    <meta property="og:url"         content="{{Request::url()}}" />

    <meta property="fb:app_id"      content="" />
    <meta property="og:title"       content="@yield('fb_title')" />
    <meta property="og:description" content="@yield('fb_description')" />
    <meta property="og:image"       content="@yield('fb_image')" />
    <meta property="og:image:type"  content="image/png">
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,700|Open+Sans:400,400i,600,600i,700,700i&amp;subset=vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">

    <link rel="stylesheet" type="text/css" href="css/magazine_header.css">
    @yield('css')
    <!-- Styles -->
</head>
<body>
    <div class="currentUrl" style="display: none;">{{ asset('') }}</div>
      @include('magazine.layouts.header')
      @yield('main')
      @include('client.layouts.footer')
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/magazine-header-footer.js"></script>

<script src="https://apis.google.com/js/platform.js"></script>


<div id="fb-root"></div>
<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.1&appId=761158710724257&autoLogAppEvents=1';
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

@yield('script')
</html>
