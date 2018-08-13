<div id="footer">

    <section id="footer-top">
        <div class="menu_footer">
            <div class="container">
                <div class="row">
                    <div class="menu_footer_left">
                        <ul>
                            <li class="lang respon768"><a href="{{ asset('') }}"><i class="fas fa-home"></i></a></li>
                            <li class="lang respon768"><a href="{{ asset('') }}">RSS</a></li>

                            <li class="lang respon768"><a href="{{ asset('') }}">Hotline 24/7:
                                    {{$web_info->hotline}}</a></li>
                            <li class="lang "><a href="{{ asset('advert/order') }}">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Đặt mua Tạp chí' : 'Magazines subcription'}}</a></li>
                            <li class="lang"><a href="{{ asset('advert/contact') }}">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Liên hệ quảng cáo' : 'Contact advertising'}}</a></li>
                        </ul>
                    </div>
                    {{-- <div class="menu_footer_right">--}}
                        {{--{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? '[Trở về đầu trang]' : '[Back to top]'}}--}}
                    {{--</div> --}}
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row footer-bottom">
                <div class="footer-left">
                    <div class="log-vnhn">
                        <a href="{{ asset('') }}"><img src="{{asset('/local/resources/uploads/images/logo-vnhn.png')}}"></a>
                    </div>
                    <div class="title">
                        <div>- {{$web_info->summary_1}}</div>
                        <div>- {{$web_info->summary_2}}</div>
                    </div>
                </div>

                <div class="footer-mid">
                    <p class="title">Việt Nam Hội Nhập</p>
                    <p class="info-footer">{{$web_info->license}}</p>
                    <p class="info-footer"><span>Tổng biên tập : {{$web_info->editor_in_chief}}</span></p>
                    <p class="info-footer"><span>Phó tổng biên tập : {{$web_info->deputy_editor}}</span></p>
                    {{-- <p class="info-footer"><span>Ủy viên HĐBT: {{$web_info->senior_executive_editor}}</span></p> --}}
                    <p class="info-footer"><span>Tòa soạn trị sự:</span>{{$web_info->address}}</p>
                    <p><span>Điện thoại :</span> {{$web_info->phone}}  * <span> Email: </span>{{$web_info->email}}</p>
                </div>

                <div class="footer-right">
                    <p class="title">*Vận hành bởi</p>
                    <div class="avatar-cgroup">
                        <a href="http://cgroupvn.com/cgroup" target="blank"><img src="{{asset('/local/resources/uploads/images/cgroup.png')}}"></a>
                    </div>
                    <p class="version-mobi">Phiên bản mobile</p>

                    <div class="logo-social">
                        <div class="google-play">
                            <a href="{{ asset('') }}"><img src="{{asset('/local/resources/uploads/images/google-play.png')}}"></a>
                        </div>
                        <div class="appstrore">
                            <a href="{{ asset('') }}"><img src="{{asset('/local/resources/uploads/images/appstore.png')}}"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <a id="desk-mobile"><i class="fas fa-desktop"></i></a>
    <a id="back-to-top"><i class="fas fa-angle-double-up"></i>

    </a>
</div>
