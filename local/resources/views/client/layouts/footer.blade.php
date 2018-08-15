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
                    {{-- <div class="menu_footer_right">
                        {{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? '[Trở về đầu trang]' : '[Back to top]'}}
                    </div> --}}
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
                    <p class="title">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Tạp chí Việt Nam Hội nhập' : 'Vietnam Integration Magazine'}}</p>
                    <p class="info-footer">{{$web_info->license}}</p>
                    <p class="info-footer"><span>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Tổng biên tập' : 'Editor-in-Chief'}} : {{$web_info->editor_in_chief}}</span></p>
                    <p class="info-footer"><span>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Phó tổng biên tập' : 'Deputy Editor'}} : {{$web_info->deputy_editor}}</span></p>
                    {{-- <p class="info-footer"><span>Ủy viên HĐBT: {{$web_info->senior_executive_editor}}</span></p> --}}
                    <p class="info-footer"><span>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Tòa soạn trị sự' : 'Journal Office-Editorial Board'}} :</span>{{$web_info->address}}</p>
                    <p><span>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Điện thoại' : 'Phone'}} :</span> {{$web_info->phone}}  * <span> Email: </span>{{$web_info->email}}</p>
                </div>

                <div class="footer-right">
                    <p class="title">*{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Vận hành bởi' : 'Powered by'}}</p>
                    <div class="avatar-cgroup">
                        <a href="http://cgroupvn.com/cgroup" target="blank"><img src="{{asset('/local/resources/uploads/images/cgroup.png')}}"></a>
                    </div>
                    <p class="version-mobi">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Phiên bản Mobile' : 'Mobile version'}}</p>

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
    <a id="back-to-top"><i class="fas fa-angle-double-up"></i>

</a>
</div>