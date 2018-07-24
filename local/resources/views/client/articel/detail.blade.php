@extends('client.master')
@section('css')
    <link rel="stylesheet" type="text/css" href="css/detail.css">
@stop
@section('main')
    <div id="main">
        <section class="section1">
            <div class="detailTitle">
                @foreach($list_group as $group)
                    @if($loop->index != 0)
                        <i class="fas fa-angle-right"></i>
                    @endif
                    <a href="{{ asset('') }}">
                        {{$group->title}}
                    </a>
                @endforeach
            </div>
            <div class="detailMain">
                <div class="mainDetailLeft">
                    <h1>{{$articel->title}}</h1>
                    <div class="mainDetailLeftTime">
                        <i class="far fa-clock"></i>
                        {{$articel->day_in_week_str}}, {{$articel->release_time}} (GMT+7)
                    </div>
                    <div class="mainDetailLeftContent">
                        {{$articel->content}}
                    </div>

                    <div class="mainDetailLeftBanner">
                        <img src="images/Banner trung tâm 1 (728x90).png">
                    </div>
                    {{-- <div class="mainDetailLeftRecommend">
                        <div class="mainDetailLeftRecommendItem left">
                            <div class="mainDetailLeftRecommendItemImg">
                                <img src="images/Layer 66.png">
                            </div>
                            <div class="mainDetailLeftRecommendItemTitle">
                                <i class="fas fa-angle-double-left"></i>
                                Bài trước
                            </div>
                            <div class="mainDetailLeftRecommendItemContent">
                                Sở Giáo dục Hà Giang đề nghị khởi tố điều tra sai phạm về điểm thi
                            </div>
                        </div>
                        <div class="mainDetailLeftRecommendItem right">
                            <div class="mainDetailLeftRecommendItemImg">
                                <img src="images/Layer 66.png">
                            </div>
                            <div class="mainDetailLeftRecommendItemTitle">
                                <i class="fas fa-angle-double-right"></i>
                                Bài tiếp
                            </div>
                            <div class="mainDetailLeftRecommendItemContent">
                                Sở Giáo dục Hà Giang đề nghị khởi tố điều tra sai phạm về điểm thi
                            </div>
                        </div>
                    </div> --}}

                    <div class="mainDetailLeftInvolve">
                        <h4 class="mainDetailLeftTitle">Bài được quan tâm</h4> 
                        <div class="mainDetailLeftInvolveMain">
                            @foreach($articel_related as $art_related)
                                <div class="mainDetailLeftInvolveItem">
                                    <div class="mainDetailLeftInvolveItemImg">
                                        <img src="{{ file_exists(asset('/local/resources'.$art_related->fimage)) ? asset('/local/resources'.$art_related->fimage) : 'http://vietnamhoinhap.vn/'.$art_related->fimage }}">
                                    </div>
                                    <div class="mainDetailLeftInvolveItemContent">
                                        {{$art_related->title}}
                                    </div>
                                    <div class="mainDetailLeftInvolveItemTime">
                                        <i class="far fa-clock"></i>
                                        {{$art_related->release_time}}
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="mainDetailLeftComment">
                        <h4 class="mainDetailLeftTitle">Ý kiến của bạn</h4> 
                        <div class="mainDetailLeftCommentMain">
                            <form method="post" action="{{route('action_comment')}}">
                                {{ csrf_field() }}
                                <label>Nội dung</label>
                                <div class="form-group">
                                    <textarea name="comment[content]" rows="4" name="content"></textarea>
                                </div>
                                <div class="mainDetailLeftCommentMainName_Email">
                                    <div class="mainDetailLeftCommentMainName">
                                        <label>Họ tên</label>
                                        <div class="form-group">
                                            <input name="comment[fullname]" type="text" name="name">
                                        </div>
                                    </div>
                                    <div class="mainDetailLeftCommentMainEmail">
                                        <label>Email</label>
                                        <div class="form-group">
                                            <input name="comment[email]" type="text" name="email">
                                        </div>
                                    </div>
                                </div>
                                <input name="comment[idnew]" value="{{$articel->id}}" class="d-none">
                                <input name="comment[groupid]" value="{{$articel->groupid}}" class="d-none">
                                <input name="comment[slug]" value="{{$articel->slug}}" class="d-none">
                                <div class="g-recaptcha" data-sitekey="6LdT0GUUAAAAAD5_seQrV-mCYa7YQZ2iQ6O_hHot"></div>
                                <div class="form-group">
                                    <input type="submit" name="sbm" value="gửi bình luận">
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="mainDetailRight">
                    <div class="mainDetailRightFollow">
                        <h4 class="mainDetailRightTitle red">Bài được quan tâm</h4>
                        <ul class="mainDetailRightList">
                            @foreach($articel_top_view as $articel)
                                <li><a href="{{ route('get_detail_articel',$articel->slug.'--'.$articel->id) }}"><i class="fas fa-caret-right"></i>{{$articel->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mainDetailRightJournal">
                        <h4 class="mainDetailRightTitle red">
                            Tạp trí thường kì
                        </h4>
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
                    </div>
                    <div class="mainDetailRightVideo">
                        <h4 class="mainDetailRightTitle red">
                            VNHN Video
                        </h4>
                        <iframe width="100%" height="auto" src="https://www.youtube.com/embed/UXdPQnSJQp8" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        <ul class="mainDetailRightList">
                            <li><a href="{{ asset('') }}"><i class="fas fa-caret-right"></i>Ra mắt CLB Nhà báo Thành Nam</a></li>
                            <li><a href="{{ asset('') }}"><i class="fas fa-caret-right"></i>Kí sự - Chuyến hành trình "Tri ân đồng đội - hướng về cội nguồn"</a></li>
                            <li><a href="{{ asset('') }}"><i class="fas fa-caret-right"></i>Bản tin tạp trí Việt Nam Hội Nhập - Ngày 07.05.2018</a></li>
                            <li><a href="{{ asset('') }}"><i class="fas fa-caret-right"></i>Kí sự - Chuyến hành trình "Tri ân đồng đội - hướng về cội nguồn"</a></li>
                            <li><a href="{{ asset('') }}"><i class="fas fa-caret-right"></i>Bản tin tạp trí Việt Nam Hội Nhập - Ngày 07.05.2018</a></li>
                        </ul>
                            
                    </div>
                    <div class="mainDetailRightAdvert">
                        <img src="images/Banner (300x250).png">
                        <img src="images/Banner (300x250).png">
                        <img src="images/Banner (300x250).png">

                    </div>
                        

                </div>

            </div>
        </section>
    </div>
@stop
@section('script')

<script type="text/javascript">
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:0,
        nav:true,
        autoHeight:true,
        responsive:{
            0:{
                items:1
            },
            992:{
                items:2
            },
            1000:{
                items:2
            }
        }
    });
</script>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>


<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
</script>
@stop
