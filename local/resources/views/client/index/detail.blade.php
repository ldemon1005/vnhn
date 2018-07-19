@extends('client.master')
@section('main')
    <link rel="stylesheet" type="text/css" href="css/detail.css">
    <div id="main">
        <section class="section1">
            <div class="detailTitle">
                <a href="{{ asset('') }}" >
                    Trang chủ
                </a>
                <i class="fas fa-angle-double-right"></i>
                <a href="{{ asset('') }}">
                    Vấn đề hôm nay
                </a>
                
            </div>
            <div class="detailMain">
                <div class="mainDetailLeft">
                    <h1>Tăng cường phát triển thương mại, du lịch giữa Hà Nội và UAE</h1>
                    <div class="mainDetailLeftTime">
                        <i class="far fa-clock"></i>
                        Thứ tư, 18/7/2018, 09:30 (GMT+7)
                    </div>

                </div>
                <div class="mainDetailRight">
                    
                </div>
            </div>
        </section>
    </div>
@stop
