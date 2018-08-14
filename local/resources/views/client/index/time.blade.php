@extends('client.master')
@section('title', 'Tin nhanh Việt Nam Hội Nhập')
@section('fb_title', 'Tin nhanh Việt Nam Hội Nhập - Cập nhật xu hướng')
@section('fb_des', 'Tạp chí VNHN là trang thông tin tạp chí đối ngoại,......')
@section('fb_img', 'http://vietnamhoinhap.vn/local/resources/uploads/2_8_2018/tescareersheadteacherrecruitment-1521781229.jpg')
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
                                    <a href="{{ route('get_detail_articel',$list_articel_hot[0]->slug.'---n-'.$list_articel_hot[0]->id) }}"  onclick="article_view('{{ $list_articel_hot[0]->id }}')">
                                        <div class="avatar" style="background: url('{{ isset($list_articel_hot[0]->fimage)  && $list_articel_hot[0]->fimage ? (file_exists(storage_path('app/article/resized500-'.$list_articel_hot[0]->fimage)) ? asset('local/storage/app/article/resized500-'.$list_articel_hot[0]->fimage) : (file_exists(resource_path($list_articel_hot[0]->fimage)) ? asset('/local/resources'.$list_articel_hot[0]->fimage) : 'images/default-image.png')) : 'images/default-image.png' }}') no-repeat center /cover;">
                                        </div>
                                        <h3 class="title mt-2">{{$list_articel_hot[0]->title}}</h3>
                                        <p class="date-time">{{$list_articel_hot[0]->release_time}}</p>
                                        <p class="caption">{{cut_string($list_articel_hot[0]->summary, 300)}}</p>
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
                                            <a href="{{ route('get_detail_articel',$top_view->slug.'---n-'.$top_view->id) }}" onclick="article_view('{{ $top_view->id }}')">
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
                                        <a href="{{ route('get_detail_articel',$list_articel_hot[$i]->slug.'---n-'.$list_articel_hot[$i]->id) }}"  onclick="article_view('{{ $list_articel_hot[$i]->id }}')">
                                            <div class="avatar" style="background: url('{{ isset($list_articel_hot[$i]->fimage)  && $list_articel_hot[$i]->fimage ? (file_exists(storage_path('app/article/resized200-'.$list_articel_hot[$i]->fimage)) ? asset('local/storage/app/article/resized200-'.$list_articel_hot[$i]->fimage) : (file_exists(resource_path($list_articel_hot[$i]->fimage)) ? asset('/local/resources'.$list_articel_hot[$i]->fimage) : 'images/default-image.png')) : 'images/default-image.png' }}') no-repeat center /cover;">
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
                            <?php $count_ad = 0?>
                            @if (count($list_ad[2]) > 0)
                                @for ($i = 0; $i < count($list_ad[2]); $i++)
                                    @if ($list_ad[2][$i]->advert->ad_status == 1)
                                        <a href="{{ $list_ad[2][$i]->advert->ad_link}}" onclick="ad_view('{{$list_ad[2][$i]->advert->ad_id}}')" target="blank"><img src="{{asset('local/storage/app/advert/'.$list_ad[2][$i]->advert->ad_img)}}"></a>
                                        <?php $count_ad++ ?>
                                    @endif
                                @endfor
                            @endif
                            @if (count($ad_home[2])>0)
                                @for ($i = 0; $i < count($ad_home[2]); $i++)
                                    @if ($ad_home[2][$i]->advert->ad_status == 1 && $count_ad == 0)
                                        <a href="{{ $ad_home[2][$i]->advert->ad_link}}" onclick="ad_view('{{$ad_home[2][$i]->advert->ad_id}}')" target="blank"><img src="{{asset('local/storage/app/advert/'.$ad_home[2][$i]->advert->ad_img)}}"></a>
                                        <?php $count_ad++ ?>
                                    @endif
                                @endfor
                            @endif
                            @if ($count_ad == 0)
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
                                    <h2>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Danh sách bài viết' : 'List article'}}</h2>
                                </div>
                                <hr style="border-top: 2px solid #000000"/>

                                <div class="list-section2-left-top">
                                    @foreach($list_articel as $articel)
                                        <div class="item">
                                            <a href="{{ route('get_detail_articel',$articel->slug.'---n-'.$articel->id) }}"  onclick="article_view('{{ $articel->id }}')">
                                                <div class="content">
                                                    <h3 class="title">{!! cut_string($articel->title,100) !!}</h3>
                                                    <p class="date-time">{{date('d/m/Y H:m',$articel->release_time)}}</p>
                                                    <p class="caption">{{cut_string($articel->summary,220)}}</p>
                                                </div>
                                                <div class="avatar" style="background: url('{{ isset($articel->fimage)  && $articel->fimage ? (file_exists(storage_path('app/article/resized500-'.$articel->fimage)) ? asset('local/storage/app/article/resized500-'.$articel->fimage) : (file_exists(resource_path($articel->fimage)) ? asset('/local/resources'.$articel->fimage) : 'images/default-image.png')) : 'images/default-image.png' }}') no-repeat center /cover;">
                                                </div>
                                            </a>
                                        </div>
                                        {{-- <hr style="border-top: 2px solid #999999"/> --}}
                                    @endforeach
                                    <div class="pagination float-right" style="padding-top: 15px">
                                        {{-- <nav aria-label="Page navigation">
                                        @if ($list_articel->lastPage() > 1)
                                            <ul class="pagination">
                                               
                                                <li class="page-item {{ ($list_articel->currentPage() == 1) ? ' disabled' : '' }}">
                                                    <a href="{{ $list_articel->url(1) }}">Previous</a>
                                                </li>
                                                
                                                <li class="page-item {{ ($list_articel->currentPage() == $list_articel->lastPage()) ? ' disabled' : '' }}">
                                                    <a href="{{ $list_articel->url($list_articel->currentPage()+1) }}" >Next</a>
                                                </li>
                                            </ul>
                                        @endif
                                        </nav> --}}
                                        {{-- {!! $list_articel->links('vendor.pagination.bootstrap-4') !!} --}}


                                        <nav aria-label="Page navigation example">
                                          @if ($list_articel->lastPage() > 1)
                                          <ul class="pagination">
                                            <li class="page-item {{ ($list_articel->currentPage() == 1) ? ' disabled' : '' }}"><a class="page-link" href="{{ $list_articel->url(1) }}">{{ \Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Trang trước' : 'Previous' }}</a></li>
                                            <li class="page-item">
                                                <span class="page-link">
                                                    {{ $list_articel->currentPage() }}
                                                <span class="sr-only">(current)</span>
                                              </span>
                                            </li>
                                            <li class="page-item {{ ($list_articel->currentPage() == $list_articel->lastPage()) ? ' disabled' : '' }}"><a class="page-link" href="{{ $list_articel->url($list_articel->currentPage()+1) }}">{{ \Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Trang tiếp' : 'Next' }}</a></li>
                                          </ul>
                                          @endif
                                        </nav>
                                    </div>
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
                                                        <a href="{{ route('get_detail_articel',$articel->slug.'---n-'.$articel->id) }}" onclick="article_view('{{ $articel->id }}')">
                                                            <h3 class="title">{!! cut_string($articel->title,100)
                                                            !!}</h3>
                                                            @if($loop->index == 0)
                                                                <div class="avatar">
                                                                    <a href="#"><img src="{{ isset($articel->fimage)  && $articel->fimage ? (file_exists(storage_path('app/article/resized500-'.$articel->fimage)) ? asset('local/storage/app/article/resized500-'.$articel->fimage) : (file_exists(resource_path($articel->fimage)) ? asset('/local/resources'.$articel->fimage) : 'images/default-image.png')) : 'images/default-image.png' }}"></a>
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
                                <?php $count_ad = 0?>
                                @if (count($list_ad[4]) > 0)
                                    @for ($i = 0; $i < count($list_ad[4]); $i++)
                                        @if ($list_ad[4][$i]->advert->ad_status == 1)
                                            <a href="{{ $list_ad[4][$i]->advert->ad_link}}" onclick="ad_view('{{$list_ad[4][$i]->advert->ad_id}}')" target="blank"><img src="{{asset('local/storage/app/advert/'.$list_ad[4][$i]->advert->ad_img)}}"></a>
                                            <?php $count_ad++ ?>
                                            {{$count_ad}}
                                        @endif
                                    @endfor
                                @endif
                                @if (count($ad_home[6])>0 && $count_ad == 0)
                                    @for ($i = 0; $i < count($ad_home[6]); $i++)
                                        @if ($ad_home[6][$i]->advert->ad_status == 1)
                                            <a href="{{ $ad_home[6][$i]->advert->ad_link}}" onclick="ad_view('{{$ad_home[6][$i]->advert->ad_id}}')" target="blank"><img src="{{asset('local/storage/app/advert/'.$ad_home[6][$i]->advert->ad_img)}}"></a>
                                            <?php $count_ad++ ?>

                                        @endif
                                    @endfor
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
                    <div class="section2-right">
                        <div class="row">

                        </div>
                        <div class="row">
                            <div class="quangcao-6">
                                <?php $count_ad = 0?>
                                @if (count($list_ad[3]) > 0)
                                    @for ($i = 0; $i < count($list_ad[3]); $i++)
                                        @if ($list_ad[3][$i]->advert->ad_status == 1)
                                            <a href="{{ $list_ad[3][$i]->advert->ad_link}}" onclick="ad_view('{{$list_ad[3][$i]->advert->ad_id}}')" target="blank"><img src="{{asset('local/storage/app/advert/'.$list_ad[3][$i]->advert->ad_img)}}"></a>
                                            <?php $count_ad++ ?>
                                        @endif
                                    @endfor
                                @endif
                                @if (count($ad_home[7])>0 && $count_ad == 0 )
                                    @for ($i = 0; $i < count($ad_home[7]); $i++)
                                        @if ($ad_home[7][$i]->advert->ad_status == 1)
                                            <a href="{{ $ad_home[7][$i]->advert->ad_link}}" onclick="ad_view('{{$ad_home[7][$i]->advert->ad_id}}')" target="blank"><img src="{{asset('local/storage/app/advert/'.$ad_home[7][$i]->advert->ad_img)}}"></a>
                                            <?php $count_ad++ ?>
                                        @endif
                                    @endfor
                                @endif
                                @if ($count_ad == 0)
                                    <a href="{{ asset('') }}">
                                        <img src="images/300x250.png">
                                    </a>
                                    
                                @endif
                                {{-- <a href="{{ asset('') }}">
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
    <script src="{{ asset('local/resources/assets/js/time.js') }}"></script>
@stop
