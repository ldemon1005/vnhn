{{-- <div class="trailer">
    Web đang chạy trên phiên bản thử nghiệm
</div> --}}
<div class="bannerMobiHeader">
    {{-- <a href="{{ asset('advert/contact') }}">
        <img src="images/414x90.jpg">
    </a> --}}
    <?php $count_ad = 0?>
    @if (count($list_ad[11]) > 0)
            @if ($list_ad[11][0]->advert->ad_status == 1)
                <a href="{{ $list_ad[11][0]->advert->ad_link}}" onclick="ad_view('{{$list_ad[11][0]->advert->ad_id}}')"><img src="{{asset('local/storage/app/advert/'.$list_ad[11][0]->advert->ad_img)}}"></a>
                <?php $count_ad++ ?>
            @endif
    @endif
    @if (count($ad_home[11]) > 0 && $count_ad == 0)
            @if ($ad_home[11][0]->advert->ad_status == 1)
                <a href="{{ $ad_home[11][0]->advert->ad_link}}" onclick="ad_view('{{$ad_home[11][0]->advert->ad_id}}')">
                    <img src="{{asset('local/storage/app/advert/'.$ad_home[11][0]->advert->ad_img)}}">
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
<div class="bannerTabletHeader">
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
<div class="bannerMobiFooter">
    <?php $count_ad = 0?>
    @if (count($list_ad[12]) > 0)
            @if ($list_ad[12][0]->advert->ad_status == 1)
                <a href="{{ $list_ad[12][0]->advert->ad_link}}" onclick="ad_view('{{$list_ad[12][0]->advert->ad_id}}')"><img src="{{asset('local/storage/app/advert/'.$list_ad[12][0]->advert->ad_img)}}"></a>
                <?php $count_ad++ ?>
            @endif
    @endif
    @if (count($ad_home[12]) > 0 && $count_ad == 0)
            @if ($ad_home[12][0]->advert->ad_status == 1)
                <a href="{{ $ad_home[12][0]->advert->ad_link}}" onclick="ad_view('{{$ad_home[12][0]->advert->ad_id}}')">
                    <img src="{{asset('local/storage/app/advert/'.$ad_home[12][0]->advert->ad_img)}}">
                </a>
                <?php $count_ad++ ?>
            @endif
    @endif
    @if ($count_ad == 0)
        <a href="{{ asset('') }}">
            <img src="images/810x100.png">
        </a>

    @endif
    <div class="btnCloseMobiFooter">
        x
    </div>
</div>

<div id="header">
    <section id="header-top">
        <div class="container">
            <div class="row ">
                <div class="top-header">
                    <div class="e-magazine">
                        <a href="{{ asset('magazine') }}"><img src="{{asset('/local/resources/uploads/images/e-magazine.png')}}"></a>
                    </div>
                    <div class="top-header-menu">
                        <ul class="menu-left">
                            <li class="header-lang"><a style="cursor: pointer" onclick="set_lang('vn')"><img style="width: auto;height: 13px;line-height: 46px" src="{{asset('/local/resources/uploads/images/vn.png')}}"></a></li>
                            <li class="separation"><img src="{{asset('/local/resources/uploads/images/cham.png')}}"></li>
                            <li class="header-lang"><a style="cursor: pointer" onclick="set_lang('en')"><img style="width: auto;height: 13px;line-height: 46px" src="{{asset('/local/resources/uploads/images/en.png')}}"></a></li>
                            <li class="separation"><img src="{{asset('/local/resources/uploads/images/cham.png')}}"></li>
                            <li class="header-lang"><a href="{{ asset('') }}"><p><i class="fas fa-phone"></i>0888.790.111</p></a></li>
                            <li class="separation"><img src="{{asset('/local/resources/uploads/images/cham.png')}}"></li>
                            <li class="header-lang"><a href="{{ asset('advert') }}" target="blank"><p><img src="{{asset('/local/resources/uploads/images/ads-icon.png')}}" style="margin-right: 5px">Quảng cáo</p></a></li>
                            <li class="separation"><img src="{{asset('/local/resources/uploads/images/cham.png')}}"></li>
                            <li class="list-icon">
                                <a href="{{$web_info->facebook}}" target="blank"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{$web_info->youtobe}}" target="blank"><i class="fab fa-youtube"></i></a>
                                {{-- <a href="{{ asset('') }}"><i class="fas fa-envelope"></i></a> --}}
                                <a href="{{ asset('') }}"><i class="fas fa-search btnShowSearch" style="color: #303840"></i></a>
                            </li>
                        </ul>
                        {{-- <div class="formSearchHide" >
                            <form id="search_video" action="" method="get">
                                <input name="key" type="text" class="form-control inputFormSearch" placeholder="Từ khóa tìm kiếm ...">
                                <a onclick="search_video()" style="cursor: pointer"><i
                                            class="fas fa-search" style="color: #303840"></i></a>
                            </form>
                        </div> --}}
                    </div>


                    {{--<div class="float-right" style="position: relative;z-index: 1000;width: 400px">--}}
                        {{--<form id="search_video" action="" method="get">--}}
                            {{--<input name="key" type="text" class="form-control" placeholder="Từ khóa tìm kiếm ...">--}}
                            {{--<a onclick="search_video()" style="cursor: pointer"><i--}}
                                        {{--class="fas fa-search" style="color: #303840"></i></a>--}}
                        {{--</form>--}}
                    {{--</div>--}}
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
                    <li class="{{ isset($group_menu_cate[0]) ? '' : 'active' }}"><a href="{{ asset('') }}"><i class="fas fa-home"></i></a></li>

                    {{-- {{$menu->child}} --}}
                    <?php $count=0?>
                    @foreach ($menu as $item)
                        @if($item->id == 19)
                            <li class="menuHeaderItem " >
                                <a href="{{$item->link}}" target="_blank">
                                    <span class="iconMenu">
                                        {!! $item->fimages !!}
                                    </span>
                                    {{$item->title}}
                                </a>
                            </li>
                        @else
                            <li class="menuHeaderItem {{ \Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? ($count > 8 ? 'menu_head_hide' : ' ') : ($count > 6 ? 'menu_head_hide' : ' ') }} {{ isset($group_menu_cate[0]) && $group_menu_cate[0]->id == $item->id ? 'active' : '' }}">
                                <a href="{{ route('get_articel_by_group',$item->slug.'---n-'.$item->id) }}">
                                    <span class="iconMenu">
                                        {!! $item->fimages !!}
                                    </span>
                                    {{$item->title,10}}
                                </a>
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
                        <li class="menuHeaderItem menu_head_hide">
                            <a class="btnSetLang" style="cursor: pointer" onclick="set_lang('vn')"><img style="width: auto;height: 13px;line-height: 46px" src="{{asset('/local/resources/uploads/images/vn.png')}}"></a>
                            <a class="btnSetLang" style="cursor: pointer" onclick="set_lang('en')"><img style="width: auto;height: 13px;line-height: 46px" src="{{asset('/local/resources/uploads/images/en.png')}}"></a>
                        </li>
                    <li class="dropdown">
                        <a>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Chuyên mục khác' : 'Other Categories'}}</a>
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
    <div class="btnAdvertContact">
        <a href="{{ asset('advert') }}">
            <img src="{{asset('/local/resources/uploads/images/ads-icon.png')}}" style="margin-right: 5px">
        </a>
    </div>
</div>

{{-- @section('script')
@stop --}}