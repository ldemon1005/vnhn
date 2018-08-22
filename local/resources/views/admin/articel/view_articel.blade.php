<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Việt Nam hội nhập!</title>

    <style type="text/css">
		.new-item {
		    width: 500px;
		    margin: 20px auto 50px;
		}
		.new-item .avatar {
		    width: auto;
		    height: auto;
		    overflow: hidden;
		    margin-bottom: 10px;
		}
		.new-item .avatar:after {
		    content: "";
		    display: block;
		    padding-top: 60%;
		}
		.new-item .title {
		    font-weight: Bold;
		    font-family: 'Merriweather', serif;
		}
		.date-time {
		    margin: -5px 0 5px;
		    font-size: 11px;
		    color: #999999;
		}		
    	.content{
    		width: 80vw;
    		margin: auto;
    	}
    	.content img{
    		max-width: 80%;
    	}
    	.mainDetailLeftInfo {
		    display: flex;
		    float: right;
		}
		.mainDetailLeftInfo p {
		    display: flex;
		    font-size: 14px;
		    font-weight: bold;
		    font-style: italic;
		    color: #999999;
		}
    </style>
</head>
<body>
	<div class="new-item">
        <div class="avatar" style="background: url('{{ isset($article->fimage)  && $article->fimage ? (file_exists(storage_path('app/article/resized500-'.$article->fimage)) ? asset('local/storage/app/article/resized500-'.$article->fimage) : (file_exists(resource_path($article->fimage)) ? asset('/local/resources'.$article->fimage) : resource_path('assets/images/default-image.png'))) : resource_path('assets/images/default-image.png') }}') no-repeat center /cover;">
        </div>
        <h3 class="title mt-2">{{$article->title}}</h3>
        <p class="date-time"><i class="far fa-clock"></i>  {{$article->release_time}}</p>
        <p class="caption">{{ cut_string($article->summary, 300)}}</p>
    </div>

	<div class="content">
		@if($relates != null)
        <div class="mainDetailLeftRelate">
            <ul style="padding-left: 20px;">
                @foreach($relates as $article_item)
                <li>
                    <a href="{{ route('get_detail_articel',$article_item->slug.'---n-'.$article_item->id) }}">
                        {{ $article_item->title }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
		{!! $log->noidung !!}
		
		<div class="mainDetailLeftInfo mb-4">
			{{-- {{ dd($article) }} --}}
            <p>{!! $article->tacgia !!}</p>
            	@if($article->tacgia != '' && $article->nguontin != '')
                <span>&nbsp;/&nbsp;</span>
            	@endif
            <p>{!! $article->nguontin !!}</p>
        </div>
       
	</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>