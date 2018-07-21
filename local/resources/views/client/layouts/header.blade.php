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
                            <li class="header-lang"><a href="#"><p><i class="fas fa-phone"></i>096 432 8383</p></a></li>
                            <li class="separation"><img src="{{asset('/local/resources/uploads/images/cham.png')}}"></li>
                            <li class="header-lang"><a href="#"><p><img src="{{asset('/local/resources/uploads/images/ads-icon.png')}}">Quảng cáo</p></a></li>
                            <li class="separation"><img src="{{asset('/local/resources/uploads/images/cham.png')}}"></li>
                            <li class="list-icon">
                                <a href=""><i class="fab fa-facebook-f"></i></a>
                                <a href=""><i class="fab fa-youtube"></i></a>
                                <a href=""><i class="fas fa-envelope"></i></a>
                                <a href=""><i class="fas fa-search" style="color: #303840"></i></a>
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
                    <a href="#"><img src="{{asset('local/resources/uploads/images/logo-vnhn.png')}}"></a>
                </div>
                <div class="quangcao-1">
                    <a href="#"><img src="{{asset('local/resources/uploads/images/quang-cao-1.png')}}"></a>
                </div>
            </div>
        </div>
    </section>

    <section id="header-menu">
        <div class="container">
            <div class="row">
                <ul class="menu-header">
                    <li><a href="{{ asset('') }}"><i class="fas fa-home"></i></a></li>
                    @foreach($menu->chunk(6)[0] as $item)
                        <li><a href="{{ asset('') }}">{{$item->title}}</a></li>
                    @endforeach
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Danh mục khác <span class="caret"></span></a>
                        <ul id="either-menu" class="dropdown-menu scrollable-menu dropdown-menu-right text-left" style="background-color: #d71a21">
                            @for($i = 6;$i<$menu->count();$i++)
                                <li><a href="#">{{$menu[$i]->title}}</a></li>
                            @endfor
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</div>

@section('script')
@stop