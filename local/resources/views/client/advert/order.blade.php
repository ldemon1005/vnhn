@extends('client.master')
@section('title', 'Đặt mua tạp chí')
@section('fb_title', 'Đặt mua tạp chí')
@section('fb_des', '')
@section('fb_img', '')


@section('css')
    <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/advertContact.css">
@stop
@section('main')
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div class="mainLeft">
                        <h1>Đặt mua tạp chí</h1>
                        <form method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <div class="formTitle">
                                        Họ tên
                                    </div>
                                </div>
                                <div class="col-md-9 col-sm-12">
                                    <div class="formInput">
                                        <input type="text" name="name" class="form-control" required> 
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <div class="formTitle">
                                        Email
                                    </div>
                                </div>
                                <div class="col-md-9 col-sm-12">
                                    <div class="formInput">
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <div class="formTitle">
                                        Điện thoại
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="formInput">
                                        <input type="number" name="phone" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="formTitle">
                                        Tỉnh /thành phố
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="formInput">
                                        <select class="form-control select2" name="address_1" id="province">
                                            <option>Chọn tỉnh/thành phố</option>
                                            @foreach($list_city as $city)
                                                <option value="{{$city->name}}" id="{{$city->matp}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <div class="formTitle">
                                        Quận /huyện
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="formInput" id="form_district">
                                        <select class="form-control select2" name="address_2" id="district_id">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="formTitle">
                                        Phường /xã
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="formInput" id="form_ward">
                                        <select class="form-control select2" name="address_3" id="ward_id">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <div class="formTitle">
                                        Số báo
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="formInput">
                                        <input type="number" name="no" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="formTitle">
                                        Số lượng
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="formInput">
                                        <input type="number" name="amount" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <div class="formTitle">
                                        Nội dung
                                    </div>
                                </div>
                                <div class="col-md-9 col-sm-12">
                                    <div class="formInput">
                                        <textarea class="form-control" name="content" rows="5" placeholder="Nội dung yêu cầu"> 
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <div class="formTitle">
                                        
                                    </div>
                                </div>
                                <div class="col-md-9 col-sm-12">
                                    <div class="formInput">
                                        <input type="submit" name="sbm" class="btnSbm" value="Gửi yêu cầu">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="mainRight">
                        <div class="mainRightHead">
                            Liên hệ
                        </div>
                        <div class="mainRightBody">
                            <div class="mainRightBodyItem_1">

                                <img src="{{ asset('local/resources/uploads/images/cgroup.png') }}">
                                <div class="mainRightBodyItem_1_title">
                                    Tập đoàn Cgroup
                                </div>
                            </div>
                            <div class="mainRightBodyItem">
                                <div class="mainRightBodyItemIcon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="mainRightBodyItemContent">
                                    <b>HCM:</b> Tầng 4,5,6, tòa nhà Cphone, số 456 Xô Viết Nghệ Tĩnh, P.25, Q. Bình Thạnh, HCM
                                </div>
                            </div>
                            <div class="mainRightBodyItem">
                                <div class="mainRightBodyItemIcon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="mainRightBodyItemContent">
                                    <b>HN:</b> Tầng 5, tòa nhà Diamond Flower, số 1 Hoàng Đạo Thúy, P. Nhân Chính, Q. Thanh Xuân
                                </div>
                            </div>
                            <div class="mainRightBodyItem">
                                <div class="mainRightBodyItemIcon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="mainRightBodyItemContent">
                                    <b>1900 - 63 - 39 - 72</b>
                                </div>
                            </div>
                            <div class="mainRightBodyItem">
                                <div class="mainRightBodyItemIcon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="mainRightBodyItemContent">
                                    <b>info@cgroupvn.com</b>
                                </div>
                            </div>
                            



                            <div class="mainRightBodyItem_2">

                                <img src="{{ asset('local/resources/uploads/images/logo-vnhn.png') }}">
                            </div>
                            <div class="mainRightBodyItem">
                                <div class="mainRightBodyItemIcon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="mainRightBodyItemContent">
                                    Tầng 8 Cung Tri thức thành phố, số 1 Tôn Thất Thuyết, P. Dịch Vọng Hậu, Q. Cầu Giấy, Hà Nội
                                </div>
                            </div>
                            <div class="mainRightBodyItem">
                                <div class="mainRightBodyItemIcon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="mainRightBodyItemContent">
                                    <b>0243.204.4488<br>
                                        02473028366</b>
                                </div>
                            </div>
                            <div class="mainRightBodyItem">
                                <div class="mainRightBodyItemIcon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="mainRightBodyItemContent">
                                    <b>info@vietnamhoinhap.vn</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    
@stop
