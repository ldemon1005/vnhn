
<!DOCTYPE html>
<html>
<head>
    <title>Chào mừng</title>
    <style type="text/css">
        body{
            padding: 0;
            margin: 0;
            font-family: arial, sans-serif;
        }
        #background{
            background: url({{asset('local/resources/assets/images/9ef017cc-c2d1-4f21-8336-a3b229a41e5a.jpg')}}) no-repeat center /cover;
            height: 100vh;
            width: 100vw;
        }
        button{
            position: absolute;
            left: 50%;
            top: 58%;
            transform: translateX(-50%);
            background-color: #d92026;
            font-size: 20px;
            color: #fff;
            font-weight: bold;
            border: 0;
            padding: 20px 100px;
            border-bottom: 3px solid #a01418;
            border-radius: 5px;
            transition: all ease-in-out .1s;
            cursor: pointer;
            outline: 0;
            margin-top: 0;
        }
        button:hover {
            background-color: #ea181f;
        }
        button:active {
            border-bottom: 0;
            margin-top: 3px;
        }
    </style>
</head>
<body>
<div id="background">
    <form method="get" action="{{route('vnhn_start')}}">
        {{csrf_field()}}
        <input style="display: none" name="start" value="2">
        <button type="submit" id="button">CẬP NHẬT</button>
    </form>
</div>

<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#button').click(function(e){
            e.preventDefault();
            $('#background').fadeOut('slow',function(){
                $('form').submit();
            } );
        });
    });
</script>
</body>

</html>