<div id="footer">
    <section id="footer-top">
        <div class="container">
            <div class="row menu-footer">
                <ul class="menu-footer-top">
                    <li class="lang"><a href="{{ asset('') }}">RSS</a></li>
                    <li class="lang respon768"><a href="{{ asset('') }}">Đặt làm trang chủ</a></li>
                    <li class="lang"><a href="{{ asset('') }}">Liên hệ quảng cáo</a></li>
                    <li class="lang respon768"><a href="{{ asset('') }}">Đường dây nóng: 0964.32.83.83</a></li>
                    <li class="lang respon768"><a href="{{ asset('') }}">Email: info@vietnamhoinhap.com</a></li>
                </ul>
            </div>

            <div class="row footer-bottom">
                <div class="footer-left">
                    <div class="log-vnhn">
                        <a href="#"><img src="{{asset('/local/resources/uploads/images/logo-vnhn.png')}}"></a>
                    </div>
                    <div class="title">
                        <p>- {{$web_info->summary_1}}</p>
                        <p>- {{$web_info->summary_2}}</p>
                    </div>
                </div>

                <div class="footer-mid">
                    <p class="title">Việt Nam Hội Nhập</p>
                    <p class="license">{{$web_info->license}}</p>
                    <p class="info-footer"><span>Tổng biên tập : {{$web_info->editor_in_chief}}</span></p>
                    <p class="info-footer"><span>Trưởng ban Điện tử : {{$web_info->e_editor}}</span></p>
                    <p class="info-footer"><span>Tòa soạn trị sự:</span>{{$web_info->address}}</p>
                    <p><span>Điện thoại : {{$web_info->phone}}  Email: </span>{{$web_info->email}}</p>
                </div>

                <div class="footer-right">
                    <p class="title">*Vận hành bởi</p>
                    <div class="avatar-cgroup">
                        <a href="#"><img src="{{asset('/local/resources/uploads/images/cgroup.png')}}"></a>
                    </div>
                    <p class="version-mobi">Phiên bản mobile</p>

                    <div class="logo-social">
                        <div class="google-play">
                            <a href="{{$web_info->link_googleplay}}"><img src="{{asset('/local/resources/uploads/images/google-play.png')}}"></a>
                        </div>
                        <div class="appstrore">
                            <a href="{{$web_info->link_appstore}}"><img src="{{asset('/local/resources/uploads/images/appstore.png')}}"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>