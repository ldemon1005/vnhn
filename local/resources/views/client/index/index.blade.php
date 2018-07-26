@extends('client.master')
@section('main')
    <div id="main">
        <section class="section1">
            <div class="container">
                <div class="row articel-new">
                    <div class="new-left">
                        <div class="row">
                            <div class="col-md-12 new-left-main">
                                <a href="{{ route('get_detail_articel',$list_articel_new[0]->slug.'---n-'.$list_articel_new[0]->id) }}" class="new-item">
                                    <div class="avatar">
                                        <img src="{{ file_exists(asset('/local/resources'.$list_articel_new[0]->fimage)) ? asset('/local/resources'.$list_articel_new[0]->fimage) : 'http://vietnamhoinhap.vn/'.$list_articel_new[0]->fimage }}">
                                    </div>
                                    <h3 class="title">{{$list_articel_new[0]->title}}</h3>
                                    <p class="date-time"><i class="far fa-clock"></i> {{$list_articel_new[0]->release_time}}</p>
                                    <p class="caption">{{$list_articel_new[0]->summary}}</p>
                                </a>
                                <div class="new-list-right">
                                    @for (  $i = 1;   $i < 6;    $i++)
                                        <a href="{{ route('get_detail_articel',$list_articel_new[$i]->slug.'---n-'.$list_articel_new[$i]->id) }}" class="new-list-right-item">
                                            <h3 class="title">
                                                {{$list_articel_new[$i]->title}}
                                            </h3>
                                            <p class="date-time">{{$list_articel_new[$i]->release_time}}</p>
                                        </a>
                                    @endfor
                                    
                                </div>
                            </div>
                                
                        </div>
                        <div class="row new-list-bottom">
                            @for (  $i = 6;   $i < 10;    $i++)
                                <div class="col-md-3">
                                    <a href="{{ route('get_detail_articel',$list_articel_new[$i]->slug.'---n-'.$list_articel_new[$i]->id) }}" class="article">
                                        <div class="avatar">
                                           <img src="{{ file_exists(asset('/local/resources'.$list_articel_new[$i]->fimage)) ? asset('/local/resources'.$list_articel_new[$i]->fimage) : 'http://vietnamhoinhap.vn/'.$list_articel_new[$i]->fimage }}">
                                        </div>
                                        <h3 class="title">{{$list_articel_new[$i]->title}}</h3>
                                        <p class="date-time">{{$list_articel_new[$i]->release_time}}</p>
                                    </a>
                                        
                                </div>
                            @endfor
                        </div>
                        <div class="row quangcao-2">
                            <a href="#"><img src="{{asset('/local/resources/uploads/images/quang-cao-2.png')}}"></a>
                        </div>
                    </div>
                    <div class="new-right">
                        <section class="new-right-1">
                            <div class="category">
                                <h3>Tạp chí thường kỳ</h3>
                            </div>
                            <div class="slide">

                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($magazine_new->slide_show as $slide_show)
                                            <div class="carousel-item {{$loop->index == 0 ? 'active' : ''}}">
                                                <img class="d-block w-100" src="{{asset('/local/resources'.$slide_show)}}" alt="Second slide">
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                            <div class="title">
                                <h3>{{$magazine_new->title}}</h3>
                            </div>
                        </section>
                        <section class="new-right-2">
                            <div class="category">
                                <h3>VNHN video</h3>
                            </div>
                            <div class="video">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe id="{{$list_video_new[0]->id}}" class="embed-responsive-item" src="{{ (file_exists(asset('/local/resources'.$list_video_new[0]->url_video)) ? : file_exists('http://vietnamhoinhap.vn/'.$list_video_new[0]->url_video) ? : '') ? : $list_video_new[0]->url_video }}" allowfullscreen></iframe>
                                </div>
                            </div>
                            <div class="list-video">
                                <ul>
                                    <li>
                                        <a style="cursor: pointer;text-decoration: none;color: #000000">
                                            <i class="fas fa-caret-right"></i>
                                            {{$list_video_new[0]->title}}
                                        </a>
                                    </li>

                                    @for($i = 1;$i < count($list_video_new); $i++)
                                        <li>
                                            <a style="cursor: pointer;text-decoration: none;color: #000000" onclick="open_video('{{route('open_video',$list_video_new[$i]->id)}}')">
                                                <i class="fas fa-caret-right"></i>
                                                {{$list_video_new[$i]->title}}
                                            </a>
                                        </li>
                                    @endfor
                                </ul>
                            </div>
                        </section>
                    </div>
                </div>

                <div class="row category-1">
                    <div class="category-1-left">
                        <div class="row menu">
                            <div class="menu-parent">
                                <a href="{{ route('get_articel_by_group',$menu_parent_item->slug.'---n-'.$menu_parent_item->id) }}">
                                    <h3>
                                        {{$menu_parent_item->title}}
                                        
                                    </h3>
                                </a>
                            </div>
                            <div class="btnShowMenuChild">
                                <i class="fas fa-ellipsis-h"></i>
                            </div>
                            <div class="menu-child">
                                <ul class="child">
                                    @for($i = 0;$i < count($menu_child_item) ;$i++)
                                        <li><a href="{{ route('get_articel_by_group',$menu_child_item[$i]->slug.'---n-'.$menu_child_item[$i]->id) }}">{{$menu_child_item[$i]->title}}</a></li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                        <div class="row content">
                            <div class="item-category">
                                <a href="{{ route('get_detail_articel',$list_articel_item[0]->slug.'---n-'.$list_articel_item[0]->id) }}">
                                    <div class="avatar" style="background: url('{{ file_exists(asset('/local/resources'.$list_articel_item[0]->fimage)) ? asset('/local/resources'.$list_articel_new[0]->fimage) : 'http://vietnamhoinhap.vn/'.$list_articel_new[0]->fimage }}') no-repeat center 100% /cover;">
                                        {{-- <img src="{{ file_exists(asset('/local/resources'.$list_articel_item[0]->fimage)) ? asset('/local/resources'.$list_articel_new[0]->fimage) : 'http://vietnamhoinhap.vn/'.$list_articel_new[0]->fimage }}"> --}}
                                    </div>
                                    <h3 class="title">{{$list_articel_item[0]->title}}</h3>
                                    <p class="date-time"><i class="far fa-clock"></i> {{$list_articel_item[0]->release_time}}</p>
                                    <p class="caption">{!! $list_articel_item[0]->summary !!}</p>
                                </a>

                            </div>
                            <div class="list-right">
                                @for($i = 1;$i < count($list_articel_item);$i++)
                                    <div class="list-right-item">
                                        <a href="{{ route('get_detail_articel',$list_articel_item[$i]->slug.'---n-'.$list_articel_item[$i]->id) }}">
                                            <div class="avatar">
                                                <img src="{{ file_exists(asset('/local/resources'.$list_articel_item[$i]->fimage)) ? asset('/local/resources'.$list_articel_new[$i]->fimage) : 'http://vietnamhoinhap.vn/'.$list_articel_new[$i]->fimage }}">
                                            </div>
                                            <h3 class="title">{{$list_articel_item[$i]->title}}</h3>
                                            <p class="date-time">{{$list_articel_item[$i]->release_time}}</p>
                                            <p class="caption">{{$list_articel_item[$i]->summary}}</p>
                                        </a>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <div class="category-1-right">
                        <div class="title">
                            <h3>Đọc nhiều</h3>
                        </div>
                        <section class="top-view">
                            @for ($i = 0; $i < count($list_top_view); $i++)
                                <a href="{{ route('get_detail_articel',$list_top_view[$i]->slug.'---n-'.$list_top_view[$i]->id) }}" class="item-top-view">
                                    <div class="stt">{{$i + 1}}.</div>
                                    <div class="caption"><h3>{{$list_top_view[$i]->title}}</h3></div>
                                    <div class="avatar">
                                        <img src="{{ file_exists(asset('/local/resources'.$list_top_view[$i]->fimage)) ? asset('/local/resources'.$list_top_view[$i]->fimage) : 'http://vietnamhoinhap.vn/'.$list_top_view[$i]->fimage }}">
                                    </div>
                                </a>
                            @endfor

                        </section>
                        
                        <div class="quangcao-3">
                            <a><img src="{{asset('/local/resources/uploads/images/quang-cao-3.png')}}"></a>
                        </div>
                    </div>
                </div>

                <div class="row quangcao-4">
                    <a href=""><img src="{{asset('/local/resources/uploads/images/quang-cao-4.png')}}"></a>
                </div>
            </div>
        </section>

        <section class="section2">
            <div class="container category">

                @foreach($list_group as $group_list)
                    <div class="row form-group ">
                        @foreach($group_list as $group)
                            <div class="col-md-3 item-category">
                                <div class="title-articel">
                                    <a href="{{ route('get_articel_by_group',$group->slug.'---n-'.$group->id) }}">
                                        <h3>{{cut_string_name($group->title,32)}}</h3>
                                    </a>
                                </div>
                                <hr/>
                                @foreach($group->articel as $articel)
                                    <div class="item">
                                        <a href="{{ route('get_detail_articel',$articel->slug.'---n-'.$articel->id) }}">
                                            @if($loop->index == 0)
                                                <div class="avatar">
                                                    <img src="{{ file_exists(asset('/local/resources'.$articel->fimage)) ? asset('/local/resources'.$articel->fimage) : 'http://vietnamhoinhap.vn/'.$articel->fimage }}">
                                                </div>
                                            @endif
                                            <div class="title">
                                                <h3>{{$articel->title}}</h3>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    <hr style="margin: 20px -15px"/>
                @endforeach
            </div>
        </section>

        <section class="section3">
            <div class="container">
                <div class="row articel-bottom">
                    <div class="articel-bottom-left">
                        <div class="row quangcao-2">
                            <a href="#"><img src="{{asset('/local/resources/uploads/images/quang-cao-2.png')}}"></a>
                        </div>

                        <div class="row menu">
                            <div class="menu-parent">
                                <a href="{{ route('get_articel_by_group',$menu_parent_item_2->slug.'---n-'.$menu_parent_item_2->id) }}">
                                    <h3>{{$menu_parent_item_2->title}}</h3>
                                </a>
                            </div>
                            <div class="btnShowMenuChild">
                                <i class="fas fa-ellipsis-h"></i>
                            </div>
                            <div class="menu-child">
                                <ul class="child">
                                    @for($i = 0;$i < count($menu_child_item_2) ;$i++)
                                        <li><a href="{{ route('get_articel_by_group',$menu_child_item_2[$i]->slug.'---n-'.$menu_child_item_2[$i]->id) }}">{{$menu_child_item_2[$i]->title}}</a></li>
                                    @endfor
                                </ul>
                            </div>
                        </div>

                        <div class="row articel-bottom-left-item">
                            @foreach($list_articel_item_2 as $articel)
                                <a href="{{ route('get_detail_articel',$articel->slug.'---n-'.$articel->id) }}">
                                    <div class="col-md-6">
                                        <div class="avatar">
                                            <a href="#"><img
                                                        src="{{ file_exists(asset('/local/resources'.$articel->fimage)) ? asset('/local/resources'.$articel->fimage) : 'http://vietnamhoinhap.vn/'.$articel->fimage }}"></a>
                                        </div>
                                        <h3 class="title">{{$articel->title}}</h3>
                                        <p class="date-time"><i class="far fa-clock"></i> {{$articel->release_time}}</p>
                                        <p class="caption">{{$articel->summary}}</p>
                                    </div>
                                </a>
                            @endforeach
                            
                        </div>
                    </div>
                    <div class="articel-bottom-right">
                        <div class="quangcao-group">
                            <div class="item-quangcao">
                                <a><img src="{{asset('/local/resources/uploads/images/quang-cao-3.png')}}"></a>
                            </div>
                            <div class="item-quangcao">
                                <a><img src="{{asset('/local/resources/uploads/images/quang-cao-3.png')}}"></a>
                            </div>
                            <div class="item-quangcao">
                                <a><img src="{{asset('/local/resources/uploads/images/quang-cao-3.png')}}"></a>
                            </div>
                            <div class="item-quangcao">
                                <a><img src="{{asset('/local/resources/uploads/images/quang-cao-3.png')}}"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
@section('script')
<script type="text/javascript" src="js/main.js"></script>
@stop
