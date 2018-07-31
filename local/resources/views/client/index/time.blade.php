@extends('client.master')
@section('css')
    <style>
        a{
            text-decoration: none;
            color: #000000;
        }
        a:hover{
            text-decoration: none;
            color: #000000;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="css/time.css">
@stop
@section('main')
    <div id="main">
        <section class="section1">
            <div class="container">
                <div class="row menu-time">
                    <ul>
                        @foreach($group_menu_cate as $menu_cate)
                            <li class="{{$menu_cate->id == $group_menu_id ? 'active' : ''}}"><a href="{{ route('get_articel_by_group',$menu_cate->slug.'---n-'.$menu_cate->id) }}">{{$menu_cate->title}}</a></li>
                        @endforeach
                    </ul>
                    <div class="btnShowListMenu"><i class="fas fa-ellipsis-h"></i>

                    </div>
                </div>

                <div class="row">
                    <div class="new-left-time">
                        <div class="new-left-time-top">

                                <div class="new-item-time">
                                    @if(count($list_articel_hot))
                                    <a href="{{ route('get_detail_articel',$list_articel_hot[0]->slug.'---n-'.$list_articel_hot[0]->id) }}">
                                        <div class="avatar" style="background: url('{{ file_exists(resource_path($list_articel_hot[0]->fimage)) ? asset('/local/resources'.$list_articel_hot[0]->fimage) : 'http://vietnamhoinhap.vn/'.$list_articel_hot[0]->fimage }}') no-repeat center /cover;">
                                        </div>
                                        <h3 class="title mt-2">{{$list_articel_hot[0]->title}}</h3>
                                        <p class="date-time">{{$list_articel_hot[0]->release_time}}</p>
                                        <p class="caption">{{$list_articel_hot[0]->summary}}</p>
                                    </a>
                                    @endif
                                </div>


                            <div class="new-list-right-time">
                                <div class="caption">
                                    <h3>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Đọc nhiều' : 'Top view'}}</h3>
                                </div>
                                <div class="list-new">
                                    @foreach($articel_top_view as $top_view)
                                        <div class="item-top-view">
                                            <a href="{{ route('get_detail_articel',$top_view->slug.'---n-'.$top_view->id) }}">
                                                <h3 class="title">{{$top_view->title}}</h3>
                                                <p class="date-time">{{$top_view->release_time}}</p>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="new-left-time-bot">
                            <div class="new-list-bottom-time">
                                @for($i = 1;$i<count($list_articel_hot);$i++)
                                    <div class="item-bottom">
                                        <a href="{{ route('get_detail_articel',$list_articel_hot[$i]->slug.'---n-'.$list_articel_hot[$i]->id) }}">
                                            <div class="avatar" style="background: url('{{ file_exists(resource_path($list_articel_hot[$i]->fimage)) ? asset('/local/resources'.$list_articel_hot[$i]->fimage) : 'http://vietnamhoinhap.vn/'.$list_articel_hot[$i]->fimage }}') no-repeat center /cover;">
                                            </div>
                                            <div class="content">
                                                <h3 class="title">{{$list_articel_hot[$i]->title}}</h3>
                                                <p class="date-time">{{$list_articel_hot[$i]->release_time}}</p>
                                            </div>
                                        </a>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="new-right-time">
                        <div class="quangcao-1">
                            <a href="{{ asset('') }}">
                                    <img src="images/300x250.png">
                                </a>
                        </div>

                        
                    </div>
                </div>
            </div>
        </section>

        <section class="section2">
            <div class="container">
                <div class="row">
                    <div class="section2-left">
                        <div class="row section2-left-top">
                            <div class="time-hot">
                                <div class="title-parent">
                                    <h2>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Danh sách bài viết' : 'List articel'}}</h2>
                                </div>
                                <hr style="border-top: 2px solid #000000"/>

                                <div class="list-section2-left-top">
                                    @foreach($list_articel as $articel)
                                        <div class="item">
                                            <a href="{{ route('get_detail_articel',$articel->slug.'---n-'.$articel->id) }}">
                                                <div class="content">
                                                    <h3 class="title">{!! cut_string($articel->title,100) !!}</h3>
                                                    <p class="date-time">{{date('d/m/Y H:m',$articel->release_time)}}</p>
                                                    <p class="caption">{{cut_string($articel->summary,220)}}</p>
                                                </div>
                                                <div class="avatar" style="background: url('{{ file_exists(resource_path($articel->fimage)) ? asset('/local/resources'.$articel->fimage) : 'http://vietnamhoinhap.vn/'.$articel->fimage }}') no-repeat center /cover;">
                                                </div>
                                            </a>
                                        </div>
                                        {{-- <hr style="border-top: 2px solid #999999"/> --}}
                                    @endforeach
                                </div>
                            </div>
                            <div class="time-subscribe">
                                @foreach($group_articel as $item)
                                    <section class="time-subscribe-top">
                                        <div class="title-parent">
                                            <h2>{{$item->title}}</h2>
                                        </div>
                                        <hr style="border-top: 2px solid #000000"/>
                                        <div class="subscribe-top">
                                            <div class="content">
                                                @foreach($item->articel as $articel)
                                                    <div class="item-top">
                                                        <a href="{{ route('get_detail_articel',$articel->slug.'---n-'.$articel->id) }}">
                                                            <h3 class="title">{!! cut_string($articel->title,100)
                                                            !!}</h3>
                                                            @if($loop->index == 0)
                                                                <div class="avatar">
                                                                    <a href="#"><img src="{{ file_exists(resource_path($articel->fimage)) ? asset('/local/resources'.$articel->fimage) : 'http://vietnamhoinhap.vn/'.$articel->fimage }}"></a>
                                                                </div>
                                                            @endif
                                                            <p class="date-time">{{$articel->release_time}}</p>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </section>
                                @endforeach
                            </div>
                        </div>
                        <div class="section2-left-bottom">
                            <div class="quangcao-7">
                                <a href="{{ asset('') }}">
                                    <img src="images/1140x125.png">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="section2-right">
                        <div class="row">

                        </div>
                        <div class="row">
                            <div class="quangcao-6">
                                <a href="{{ asset('') }}">
                                    <img src="images/300x250.png">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@stop

@section('script')
    <script src="{{ asset('local/resources/assets/js/time.js') }}"></script>
@stop
