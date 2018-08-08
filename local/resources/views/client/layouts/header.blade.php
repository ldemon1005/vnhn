<div class="trailer">
    Web đang chạy trên phiên bản thử nghiệm
</div>
<div id="header">
    <section id="header-top">
        <div class="container">
            <div class="row ">
                <div class="top-header">
                    <div class="e-magazine">
                        <a href="{{ asset('') }}"><img src="{{asset('/local/resources/uploads/images/e-magazine.png')}}"></a>
                    </div>
                    <div class="top-header-menu">
                        <ul class="menu-left">
                            <li class="header-lang"><a style="cursor: pointer" onclick="set_lang('vn')"><img style="width: auto;height: 13px;line-height: 46px" src="{{asset('/local/resources/uploads/images/vn.png')}}"></a></li>
                            <li class="separation"><img src="{{asset('/local/resources/uploads/images/cham.png')}}"></li>
                            <li class="header-lang"><a style="cursor: pointer" onclick="set_lang('en')"><img style="width: auto;height: 13px;line-height: 46px" src="{{asset('/local/resources/uploads/images/en.png')}}"></a></li>
                            <li class="separation"><img src="{{asset('/local/resources/uploads/images/cham.png')}}"></li>
                            <li class="header-lang"><a href="{{ asset('') }}"><p><i class="fas fa-phone"></i>0888.790.111</p></a></li>
                            <li class="separation"><img src="{{asset('/local/resources/uploads/images/cham.png')}}"></li>
                            <li class="header-lang"><a href="{{ asset('') }}"><p><img src="{{asset('/local/resources/uploads/images/ads-icon.png')}}">Quảng cáo</p></a></li>
                            <li class="separation"><img src="{{asset('/local/resources/uploads/images/cham.png')}}"></li>
                            <li class="list-icon">
                                <a href="{{$web_info->facebook}}"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{$web_info->youtobe}}"><i class="fab fa-youtube"></i></a>
                                <a href="{{ asset('') }}"><i class="fas fa-envelope"></i></a>
                                <a href="{{ asset('') }}"><i class="fas fa-search" style="color: #303840"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="header-banner">
        <div class="container">
            <div class="row">
                <div class="logo-vnhn">
                    <a href="{{ asset('') }}"><img src="{{asset('local/resources/uploads/images/logo-vnhn.png')}}"></a>
                </div>
                <div class="quangcao-1 item-quangcao">
                    <?php $count_ad = 0?>
                    @if (count($list_ad[1]) > 0)
                            @if ($list_ad[1][0]->advert->ad_status == 1)
                                <a href="{{ $list_ad[1][0]->advert->ad_link}}" onclick="ad_view('{{$list_ad[1][0]->advert->ad_id}}')" target="_blank" ><img src="{{asset('local/storage/app/advert/'.$list_ad[1][0]->advert->ad_img)}}"></a>
                                <?php $count_ad++ ?>
                            @endif
                    @endif
                    @if (count($ad_home[1]) > 0 && $count_ad == 0)
                            @if ($ad_home[1][0]->advert->ad_status == 1)
                                <a href="{{ $ad_home[1][0]->advert->ad_link}}" onclick="ad_view('{{$ad_home[1][0]->advert->ad_id}}')" target="_blank" >
                                    <img src="{{asset('local/storage/app/advert/'.$ad_home[1][0]->advert->ad_img)}}">
                                </a>
                                <?php $count_ad++ ?>
                            @endif
                    @endif
                    @if ($count_ad == 0)
                        <a href="{{ asset('') }}">
                            <img src="images/810x100.png">
                        </a>
                        
                    @endif
                        
                    
                    
                    
                </div>
            </div>
        </div>
    </section>

    <section id="header-menu">
        <div class="container">
            <div class="row">
                <ul class="menu-header">
                    <li><a href="{{ asset('') }}"><i class="fas fa-home"></i></a></li>

                    {{-- {{$menu->child}} --}}
                    <?php $count=0?>
                    @foreach ($menu as $item)
                        @if($item->id == 19)
                            <li class="menuHeaderItem"><a href="{{$item->link}}" target="_blank">{{$item->title}}</a></li>
                        @else
                            <li class="menuHeaderItem @if ( $count > 5 ) menu_head_hide @endif">
                                <a href="{{ route('get_articel_by_group',$item->slug.'---n-'.$item->id) }}">{{$item->title}}</a>
                                <?php $count1 = 0?>
                                @if (isset($item->child) && $item->child->count())
                                <ul>
                                    @foreach ($item->child as $child)
                                        <li>
                                            <a href="{{ route('get_articel_by_group',$child->slug.'---n-'.$child->id) }}">{{$child->title}}</a>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="btn_dropdown_menu_head">
                                    <i class="fas fa-angle-down"></i>
                                </div>

                                @endif
                            </li>
                        @endif
                        <?php $count++;?>
                    @endforeach
                    
                    <li class="dropdown">
                        <a>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Chuyên mục khác' : 'Category orther'}}</a>
                        <?php $count1 = 0?>
                        <ul class="dropdown_child">
                            @for($i = 6; $i < $menu->count(); $i++)
                                <li><a href="{{ route('get_articel_by_group',$menu[$i]->slug.'---n-'.$menu[$i]->id) }}">{{$menu[$i]->title}}</a></li>
                            @endfor
                        </ul>
                        <div class="btn_dropdown_menu_head unclick" >
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </li>
                    <div class="btn_close_menu">
                        <i class="fas fa-times"></i>
                    </div>  
                </ul>
            </div>
        </div>
    </section>
    <div id="header_btnMenu">
        <i class="fas fa-bars"></i>
    </div>
</div>

{{-- @section('script')
@stop --}}