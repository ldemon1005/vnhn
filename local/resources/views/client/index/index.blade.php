@extends('client.master')
@section('title', 'Tin nhanh Việt Nam Hội Nhập')
@section('fb_title', 'Tin nhanh Việt Nam Hội Nhập - Cập nhật xu hướng')
@section('fb_des', 'Tạp chí VNHN là trang thông tin tạp chí đối ngoại,......')
@section('fb_img', 'http://vietnamhoinhap.vn/local/resources/uploads/2_8_2018/tescareersheadteacherrecruitment-1521781229.jpg')

@section('main')
    <div id="main">
        <section class="section1 mt-4">
            <div class="container">
                <div class="row articel-new">
                    <div class="new-left">
                        <div class="row">
                            <div class="col-md-12 new-left-main">
                                <a href="{{ route('get_detail_articel',$list_articel_new[0]->slug.'---n-'.$list_articel_new[0]->id) }}" class="new-item" onclick="article_view('{{ $list_articel_new[0]->id }}')">
                                    <div class="avatar" style="background: url('{{ isset($list_articel_new[0]->fimage)  && $list_articel_new[0]->fimage ? (file_exists(storage_path('app/article/resized500-'.$list_articel_new[0]->fimage)) ? asset('local/storage/app/article/resized500-'.$list_articel_new[0]->fimage) : (file_exists(resource_path($list_articel_new[0]->fimage)) ? asset('/local/resources'.$list_articel_new[0]->fimage) : 'images/default-image.png')) : 'images/default-image.png' }}') no-repeat center /cover;">
                                    </div>
                                    <h3 class="title mt-2">{{$list_articel_new[0]->title}}</h3>
                                    <p class="date-time"><i class="far fa-clock"></i> {{$list_articel_new[0]->release_time}}</p>
                                    <p class="caption">{{ cut_string($list_articel_new[0]->summary, 300)}}</p>
                                </a>
                                <div class="new-list-right">
                                    @for (  $i = 1;   $i < 6;    $i++)
                                        <a href="{{ route('get_detail_articel',$list_articel_new[$i]->slug.'---n-'.$list_articel_new[$i]->id) }}" class="new-list-right-item" onclick="article_view('{{ $list_articel_new[$i]->id }}')">
                                            <h3 class="title">
                                                {{$list_articel_new[$i]->title}}
                                            </h3>
                                            <p class="date-time">{{$list_articel_new[$i]->release_time}}</p>
                                        </a>
                                    @endfor

                                </div>
                            </div>

                        </div>
                        <div class="row new-list-bottom mb-3">
                            @for (  $i = 6;   $i < 10;    $i++)
                                <div class="col-md-3">
                                    <a href="{{ route('get_detail_articel',$list_articel_new[$i]->slug.'---n-'.$list_articel_new[$i]->id) }}" class="article" onclick="article_view('{{ $list_articel_new[$i]->id }}')">
                                        <div class="avatar" style="background-image: url('{{ isset($list_articel_new[$i]->fimage)  && $list_articel_new[$i]->fimage ? (file_exists(storage_path('app/article/resized200-'.$list_articel_new[$i]->fimage)) ? asset('local/storage/app/article/resized200-'.$list_articel_new[$i]->fimage) : (file_exists(resource_path($list_articel_new[$i]->fimage)) ? asset('/local/resources'.$list_articel_new[$i]->fimage) : 'images/default-image.png')) : 'images/default-image.png' }}');">
                                        </div>
                                        <h3 class="title mt-2">{{$list_articel_new[$i]->title}}</h3>
                                        <p class="date-time">{{$list_articel_new[$i]->release_time}}</p>
                                    </a>
                                        
                                </div>
                            @endfor
                        </div>
                        <div class="row quangcao-2 item-quangcao mb-4" >
                            <?php $count_ad = 0?>
                            @if (count($list_ad[3]) > 0)
                                @if ($list_ad[3][0]->advert->ad_status == 1)
                                    <a href="{{ $list_ad[3][0]->advert->ad_link}}"><img src="{{asset('local/storage/app/advert/'.$list_ad[3][0]->advert->ad_img)}}"></a>
                                    <?php $count_ad++ ?>
                                @endif
                            @endif

                            @if ($count_ad == 0)
                                <a href="{{ asset('') }}">
                                    <img src="images/728x90.png">
                                </a>

                            @endif
                            {{-- <a href="{{ asset('') }}">
                                <img src="images/728x90.png">
                            </a> --}}
                        </div>

                        <div class="category-1">
                            <div class="category-1-left">
                                <div class="menu">
                                    <div class="menu-parent">
                                        <h3>
                                            <a href="{{ route('get_articel_by_group',$menu_parent_item->slug.'---n-'.$menu_parent_item->id) }}">
                                                {{cut_string($menu_parent_item->title,30)}}
                                            </a>
                                        </h3>
                                    </div>
                                    <div class="menu-child">
                                        <ul class="child">
                                            @for($i = 0;$i < count($menu_child_item) ;$i++)
                                                <li><a href="{{ route('get_articel_by_group',$menu_child_item[$i]->slug.'---n-'.$menu_child_item[$i]->id) }}">{{$menu_child_item[$i]->title}}</a></li>
                                            @endfor
                                        </ul>
                                    </div>
                                    <div class="btnShowMenuChild">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </div>
                                </div>
                                <div class="row content">
                                    @if(count($list_articel_item))
                                        <div class="item-category">
                                            <a href="{{ route('get_detail_articel',$list_articel_item[0]->slug.'---n-'.$list_articel_item[0]->id) }}" onclick="article_view('{{ $list_articel_item[0]->id }}')">
                                                <div class="avatar" style="background: url('{{ isset($list_articel_item[0]->fimage)  && $list_articel_item[0]->fimage ? (file_exists(storage_path('app/article/resized500-'.$list_articel_item[0]->fimage)) ? asset('local/storage/app/article/resized500-'.$list_articel_item[0]->fimage) : (file_exists(resource_path($list_articel_item[0]->fimage)) ? asset('/local/resources'.$list_articel_item[0]->fimage) : 'images/default-image.png')) : 'images/default-image.png' }}') no-repeat center 100% /cover;">
                                                    
                                                </div>
                                                <div class="news-meta">
                                                    <h3 class="title mt-2">{{$list_articel_item[0]->title}}</h3>
                                                    <p class="date-time"><i class="far fa-clock"></i> {{$list_articel_item[0]->release_time}}</p>
                                                    <p class="caption">{!! $list_articel_item[0]->summary !!}</p>
                                                </div>
                                            </a>
                                        </div>
                                    @endif

                                    <div class="list-right">
                                        @for($i = 1;$i < count($list_articel_item);$i++)
                                            <div class="list-right-item">
                                                <a href="{{ route('get_detail_articel',$list_articel_item[$i]->slug.'---n-'.$list_articel_item[$i]->id) }}" onclick="article_view('{{ $list_articel_item[$i]->id }}')">
                                                    <div class="avatar" style="background: url('{{ isset($list_articel_item[$i]->fimage)  && $list_articel_item[$i]->fimage ? (file_exists(storage_path('app/article/resized200-'.$list_articel_item[$i]->fimage)) ? asset('local/storage/app/article/resized200-'.$list_articel_item[$i]->fimage) : (file_exists(resource_path($list_articel_item[$i]->fimage)) ? asset('/local/resources'.$list_articel_item[$i]->fimage) : 'images/default-image.png')) : 'images/default-image.png' }}') no-repeat center /cover;">
                                                    </div>
                                                    <div class="news-meta">
                                                        <h3 class="title">{{$list_articel_item[$i]->title}}</h3>
                                                        <p class="date-time">{{$list_articel_item[$i]->release_time}}</p>
                                                        <p class="caption">{{$list_articel_item[$i]->summary}}</p>
                                                    </div>
                                                </a>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="new-right">
                        

                        <div class="item-quangcao">
                            @if (count($list_ad[2]) > 0)
                                <a href="{{ $list_ad[2][0]->advert->ad_link}}"><img src="{{asset('local/storage/app/advert/'.$list_ad[2][0]->advert->ad_img)}}"></a>
                            @else
                                <a href="{{ asset('') }}">
                                    <img src="images/300x250.png">
                                </a>
                            @endif

                           
                            {{-- <a href="{{ asset('') }}">
                                <img src="images/300x250.png">
                            </a> --}}
                        </div>
                        <section class="new-right-2">
                            <div class="category">
                                <h3>VNHN video</h3>
                            </div>
                            <div class="video">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe id="{{$list_video_new[0]->id}}" class="embed-responsive-item" src="{{ (file_exists(resource_path($list_video_new[0]->url_video)) ? : file_exists('http://vietnamhoinhap.vn/'.$list_video_new[0]->url_video) ? : '') ? : $list_video_new[0]->url_video }}" allowfullscreen></iframe>
                                </div>
                            </div>
                            <div class="list-video">
                                <ul>
                                    <li>
                                        <a>
                                            <i class="fas fa-caret-right mr-1"></i>{{$list_video_new[0]->title}}
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

                        <!-- đọc nhiều -->
                        <div class="category-1">
                            <div class="category-1-right">
                                <div class="title">
                                    <h3>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Đọc nhiều' : 'Top view'}}</h3>
                                </div>
                                <section class="top-view">
                                    @for ($i = 0; $i < count($list_top_view); $i++)
                                        <a href="{{ route('get_detail_articel',$list_top_view[$i]->slug.'---n-'.$list_top_view[$i]->id) }}" class="item-top-view" onclick="article_view('{{ $list_top_view[$i]->id }}')">
                                            <div class="stt">{{$i + 1}}.</div>
                                            <div class="caption"><h3>{{$list_top_view[$i]->title}}</h3></div>
                                            <div class="avatar">
                                                <img src="{{ file_exists(resource_path($list_top_view[$i]->fimage)) ? asset('/local/resources'.$list_top_view[$i]->fimage) : 'http://vietnamhoinhap.vn/'.$list_top_view[$i]->fimage }}">
                                            </div>
                                        </a>
                                    @endfor

                                </section>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row quangcao-4 item-quangcao">
                    <div class="quangcao-3 item-quangcao">
                        <?php $count_ad = 0?>
                        @if (count($list_ad[5]) > 0)
                            
                            @if ($list_ad[5][0]->advert->ad_status == 1)
                                <a href="{{ $list_ad[5][0]->advert->ad_link}}"><img src="{{asset('local/storage/app/advert/'.$list_ad[5][0]->advert->ad_img)}}"></a>
                                <?php $count_ad++ ?>
                            @endif
                            
                        @endif

                        @if ($count_ad == 0)
                            <a href="{{ asset('') }}">
                                <img src="images/1140x125.png">
                            </a>

                        @endif
                        {{-- <a href="{{ asset('') }}">
                            <img src="images/1140x125.png">
                        </a> --}}
                    </div>
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
                                    <h3>
                                        <a href="{{ route('get_articel_by_group',$group->slug.'---n-'.$group->id) }}">{{cut_string($group->title,32)}}</a>
                                    </h3>
                                </div>
                                @foreach($group->articel as $articel)
                                    <div class="item">
                                        <a href="{{ route('get_detail_articel',$articel->slug.'---n-'.$articel->id) }}" onclick="article_view('{{ $articel->id }}')">
                                            @if($loop->index == 0)
                                                <div class="avatar" style="background: url('{{ isset($articel->fimage)  && $articel->fimage ? (file_exists(storage_path('app/article/resized200-'.$articel->fimage)) ? asset('local/storage/app/article/resized200-'.$articel->fimage) : (file_exists(resource_path($articel->fimage)) ? asset('/local/resources'.$articel->fimage) : 'images/default-image.png')) : 'images/default-image.png' }}') no-repeat center /cover;">
                                                    
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
                        <div class="row quangcao-2 mb-4 item-quangcao">
                            <?php $count_ad = 0?>
                            @if (count($list_ad[6]) > 0)
                                    @if ($list_ad[6][0]->advert->ad_status == 1)
                                        <a href="{{ $list_ad[6][0]->advert->ad_link}}"><img src="{{asset('local/storage/app/advert/'.$list_ad[6][0]->advert->ad_img)}}"></a>
                                        <?php $count_ad++ ?>
                                    @endif
                            @endif

                            @if ($count_ad == 0)
                                <a href="{{ asset('') }}">
                                    <img src="images/728x90.png">
                                </a>

                            @endif
                           
                        </div>

                        <div class="menu">
                            <div class="menu-parent">                                
                                <h3>
                                    <a href="{{ route('get_articel_by_group',$menu_parent_item_2->slug.'---n-'.$menu_parent_item_2->id) }}">{{cut_string($menu_parent_item_2->title,30)}}</a>
                                </h3>
                            </div>
                            <div class="menu-child">
                                <ul class="child">
                                    @for($i = 0;$i < count($menu_child_item_2) ;$i++)
                                        <li><a href="{{ route('get_articel_by_group',$menu_child_item_2[$i]->slug.'---n-'.$menu_child_item_2[$i]->id) }}">{{$menu_child_item_2[$i]->title}}</a></li>
                                    @endfor
                                </ul>
                            </div>
                            <div class="btnShowMenuChild">
                                <i class="fas fa-ellipsis-h"></i>
                            </div>
                        </div>

                        <div class="row articel-bottom-left-item">
                            @foreach($list_articel_item_2 as $articel)
                                
                                <div class="col-md-6 mb-3">
                                    <a href="{{ route('get_detail_articel',$articel->slug.'---n-'.$articel->id) }}" onclick="article_view('{{ $articel->id }}')">
                                        <div class="avatar" style="background: url('{{ isset($articel->fimage)  && $articel->fimage ? (file_exists(storage_path('app/article/resized200-'.$articel->fimage)) ? asset('local/storage/app/article/resized200-'.$articel->fimage) : (file_exists(resource_path($articel->fimage)) ? asset('/local/resources'.$articel->fimage) : 'images/default-image.png')) : 'images/default-image.png' }}') no-repeat center /cover;">
                                        </div>
                                        <h3 class="title">{{$articel->title}}</h3>
                                        <p class="date-time"><i class="far fa-clock"></i> {{$articel->release_time}}</p>
                                        <p class="caption">{{$articel->summary}}</p>
                                    </a>
                                </div>
                            @endforeach
                            
                        </div>
                    </div>
                    <div class="articel-bottom-right">
                        <div class="quangcao-group">
                            <section class="new-right-1">
                                <div class="category">
                                    <h3>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Tạp chí thường kỳ' : 'Regular magazine'}}</h3>
                                </div>
                                <div class="slide">

                                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach($magazine_new as $item)
                                                <div class="carousel-item {{$loop->index == 0 ? 'active' : ''}}">
                                                    <img class="d-block w-100" src="{{asset('/local/storage/app/magazine/'.$item->m_img)}}" alt="Second slide">
                                                    <div class="title">
                                                        <h3>{{$item->m_title}}</h3>
                                                    </div>
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
                                    {{-- <h3>{{$magazine_new->title}}</h3> --}}
                                </div>
                            </section>
                            
                            <div class="quangcao_right">
                                <?php $count_ad = 0?>
                                @if (count($list_ad[7]) > 0)
                                    @for ($i = 0; $i < count($list_ad[7]); $i++)
                                        @if ($list_ad[7][$i]->advert->ad_status == 1)
                                            <a href="{{ $list_ad[7][$i]->advert->ad_link}}"><img src="{{asset('local/storage/app/advert/'.$list_ad[7][$i]->advert->ad_img)}}"></a>
                                            <?php $count_ad++ ?>
                                        @endif
                                    @endfor
                                @endif

                                @if ($count_ad == 0)
                                    <a href="{{ asset('') }}">
                                        <img src="images/300x250.png">
                                    </a>

                                @endif
                               {{--  <a href="{{ asset('') }}">
                                    <img src="images/300x250.png">
                                </a> --}}
                                
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
