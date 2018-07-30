@extends('client.master')
@section('css')
    <style>
        .error{
            color: red;
            font-style: italic;
        }
    </style>
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
                        {!! $articel->content !!}
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
                    <div class="mainDetailLeftComment">
                        <h4 class="mainDetailLeftTitle">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Ý kiến của bạn' : 'Your opinion'}}</h4>
                        <div class="mainDetailLeftCommentMain">
                            <form id="comment_art" method="post" action="{{route('action_comment')}}">
                                {{ csrf_field() }}
                                <label>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Nội dung' : 'Content'}}</label>
                                <div class="form-group">
                                    <textarea name="comment[content]" rows="4" required></textarea>
                                </div>
                                <div class="mainDetailLeftCommentMainName_Email">
                                    <div class="mainDetailLeftCommentMainName">
                                        <label>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Họ tên' : 'Fullname'}}</label>
                                        <div class="form-group">
                                            <input name="comment[fullname]" type="text" required>
                                        </div>
                                    </div>
                                    <div class="mainDetailLeftCommentMainEmail">
                                        <label>Email</label>
                                        <div class="form-group">
                                            <input name="comment[email]" type="email"  required>
                                        </div>
                                    </div>
                                </div>
                                <input name="comment[idnew]" value="{{$articel->id}}" class="d-none">
                                <input name="comment[groupid]" value="{{$articel->groupid}}" class="d-none">
                                <input name="comment[slug]" value="{{$articel->slug}}" class="d-none">
                                <div class="g-recaptcha" data-sitekey="{{env('KEY_GOOGLE_CAPTCHA')}}"></div>
                                <div class="form-group" style="margin-top: 10px">
                                    <button id="submit-comment" type="button" class="btn btn-danger">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'gửi bình luận' : 'submit comment'}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="mainDetailLeftInvolve">
                        <h4 class="mainDetailLeftTitle">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Bài được quan tâm' : 'Interested articel'}}</h4>
                        <div class="mainDetailLeftInvolveMain">
                            @foreach($articel_related as $art_related)
                                <div class="mainDetailLeftInvolveItem">
                                    <a href="{{ route('get_detail_articel',$art_related->slug.'---n-'.$art_related->id) }}">
                                        <div class="mainDetailLeftInvolveItemImg">
                                            <img src="{{ file_exists(resource_path($art_related->fimage)) ? asset('/local/resources'.$art_related->fimage) : 'http://vietnamhoinhap.vn/'.$art_related->fimage }}">
                                        </div>
                                        <div class="mainDetailLeftInvolveItemContent">
                                            {{$art_related->title}}
                                        </div>
                                        <div class="mainDetailLeftInvolveItemTime">
                                            <i class="far fa-clock"></i>
                                            {{$art_related->release_time}}
                                        </div>
                                    </a>

                                </div>
                            @endforeach

                        </div>
                    </div>


                </div>
                <div class="mainDetailRight">
                    <div class="mainDetailRightFollow">
                        <h4 class="mainDetailRightTitle red">{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Bài được quan tâm' : 'Interested articel'}}</h4>
                        <ul class="mainDetailRightList">
                            @foreach($articel_top_view as $articel)
                                <li><a href="{{ route('get_detail_articel',$articel->slug.'---n-'.$articel->id) }}"><i class="fas fa-caret-right"></i>{{$articel->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mainDetailRightJournal">
                        <h4 class="mainDetailRightTitle red">
                            {{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Tạp trí thường kì' : 'Regular magazine'}}
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
                        <ul class="mainDetailRightList">
                            @foreach($list_video_new as $video)

                                @if($loop->index == 0)
                                    @if(file_exists(resource_path($video->url_video)))
                                        <video height="auto" width="100%">
                                            <source src="{{ asset('/local/resources'.$video->url_video) }}">
                                        </video>
                                    @else
                                        <iframe width="100%" height="auto" src="{{ (file_exists(resource_path($video->url_video)) ? : file_exists('http://vietnamhoinhap.vn/'.$video->url_video) ? : '') ? : $video->url_video }}">
                                        </iframe>
                                    @endif
                                @endif
                                <li><a style="cursor: pointer" onclick="open_video('{{route('open_video',$video->id)}}')"><i class="fas fa-caret-right"></i>{{$video->title}}</a></li>

                            @endforeach
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
    <script src="js/jquery.validate.min.js"></script>

    <script type="text/javascript">
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            autoHeight: true,
            responsive: {
                0: {
                    items: 1
                },
                992: {
                    items: 2
                },
                1000: {
                    items: 2
                }
            }
        });
    </script>



    @if(\Illuminate\Support\Facades\Config::get('app.locale') == 'vn')
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @else
        <script src="https://www.google.com/recaptcha/api.js?hl=en" async defer></script>
    @endif
    {{--<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>--}}
    <script>
        $("#comment_art").validate({
            ignore: [],
            rules: {
                'comment[content]': {
                    required: true
                },
                'articel[fullname]': {
                    required: true
                },
                'articel[email]': {
                    required: true,
                    email: true
                }
            },
            messages: {
                'comment[content]': {
                    required: 'Vui lòng nhập nội dung'
                },
                'comment[fullname]': {
                    required: 'Vui lòng nhập họ tên'
                },
                'comment[email]': {
                    required: 'Vui lòng chọn email',
                    email: 'Vui lòng nhập đúng định dạnh email'
                }
            }
        });


        $('#submit-comment').click(function () {
            var recaptcha = $("#g-recaptcha-response").val();
            if (recaptcha != '') {
                $('#comment_art').submit();
            }
        })
    </script>
@stop
