<link rel="stylesheet" type="text/css" href="css/aside.css">
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
{{-- <a href="index3.html" class="brand-link">
  <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
       style="opacity: .8">
  <span class="brand-text font-weight-light">AdminLTE 3</span>
</a> --}}

<!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <div class="avatarImgSidebar" style="background: url('{{ file_exists(storage_path('app/avatar/'.Auth::user()->img)) && Auth::user()->img ? asset('local/storage/app/avatar/resized-'.Auth::user()->img) : '../images/images.png' }}') no-repeat center /cover;">

                </div>

            </div>
            <div class="info">
                <a href="{{ asset('admin') }}" class="d-block">{{Auth::user()->fullname}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="{{ asset('admin') }}" class="nav-link @if (Request::segment(2) == '') active @endif">
                        <i class="nav-icon fa fa-dashboard"></i>
                        <p>
                            {{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Thống kê' : 'Dashboard'}}
                        </p>
                    </a>
                </li>
                @if (Auth::user()->level < 4 && Auth::user()->site == 1)
                    <li class="nav-item has-treeview">
                        <a href="{{ asset('admin/') }}"
                           class="nav-link @if (Request::segment(2) == 'account') active @endif">
                        <i class="fas fa-users-cog nav-icon"></i>
                        <p>
                            {{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Quản lí tài khoản' : 'Account management'}}
                            <i class="right fa fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ asset('admin/account') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Danh sách tài khoản' : 'Account list'}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ asset('admin/account/add') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Thêm mới' : 'Add new'}}</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                @endif

                <li class="nav-item has-treeview">
                    <a href="{{ asset('admin/') }}" class="nav-link @if (Request::segment(2) == 'profile') active @endif">
                    <i class="fas fa-user-shield nav-icon"></i>
                    <p>
                        {{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Cá Nhân' : 'Profile'}}
                        <i class="right fa fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ asset('admin/profile') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Thông tin cá nhân' : 'Change information'}}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ asset('admin/profile/change_pass') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Đổi mật khẩu' : 'Change Password'}}</p>
                            </a>
                        </li>

                    </ul>
                </li>
                @if (Auth::user()->level < 3 && Auth::user()->site == 1)
                    <li class="nav-item has-treeview">
                        <a href="{{ asset('admin') }}" class="nav-link  @if (Request::segment(2) == 'group') active @endif" >
                            <i class="nav-icon fas fa-ellipsis-h"></i>
                            <p>
                                {{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Danh mục' : 'Category'}}
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (Auth::user()->site == 1)
                                <li class="nav-item">
                                    <a href="{{route('form_sort_group','00')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Sắp xếp trang chủ' : 'Sort Categories'}}</p>
                                    </a>
                                </li>
                            @endif

                            {{--@if (Auth::user()->site == 1)--}}
                                {{--<li class="nav-item">--}}
                                    {{--<a href="{{route('form_sort_group_category','00')}}" class="nav-link">--}}
                                        {{--<i class="fa fa-circle-o nav-icon"></i>--}}
                                        {{--<p>Sắp xếp danh mục</p>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                            {{--@endif--}}

                            <li class="nav-item">
                                <a href="{{route('admin_group')}}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Danh sách mục' : 'Categories list'}}</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <li class="nav-item has-treeview">
                    <a href="{{ asset('admin') }}" class="nav-link  @if (Request::segment(2) == 'articel') active @endif">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            {{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Quản trị tin' : 'Article management'}}
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{route('admin_articel')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Danh sách bài viết' : 'Article list'}}</p>
                            </a>
                        </li>
                        @if (Auth::user()->level < 4)
                        <li class="nav-item">
                            <a href="{{asset('admin/articel/approved')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Phê duyệt bài viết' : 'Approve'}}</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->level < 3 && Auth::user()->site == 2)
                        <li class="nav-item">
                            <a href="{{asset('admin/articel/approved_cgroup')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Phê duyệt bài viết(Cgroup)' : 'Approve (Cgroup)'}}</p>
                            </a>
                        </li>
                        @endif
                        
                        @if (Auth::user()->level < 3)
                            <li class="nav-item">
                                <a href="{{route('sort_hot_articel')}}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Danh sách bài viết hot' : 'Sort articles'}}</p>
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a href="{{route('form_articel',0)}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Viết bài' : 'Add new'}}</p>
                            </a>
                        </li>
                        @if (Auth::user()->level == 3 && Auth::user()->site == 1)
                            <li class="nav-item">
                                <a href="{{route('post_article')}}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Bài đã đăng' : 'Article post'}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('returned_article')}}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Bài bị trả lại' : 'Article returned'}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('wait_article')}}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Bài chờ duyệt' : 'Article wait'}}</p>
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a href="{{route('draft_article')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Bài viết nháp' : 'Draft article'}}</p>
                            </a>
                        </li>

                    </ul>
                </li>
                {{-- @if (Auth::user()->level < 4 )
                    <li class="nav-item has-treeview">
                        <a href="{{ asset('admin') }}" class="nav-link  @if (Request::segment(2) == 'topic') active @endif">
                            <i class="nav-icon fas fa-bookmark"></i>
                            <p>
                                {{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Chuyên đề' : 'Topic'}}
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{route('admin_topic')}}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Danh sách chuyên đề' : 'Topic list'}}</p>
                                </a>
                            </li>
                            @if (Auth::user()->level < 3 && Auth::user()->site == 1)
                                <li class="nav-item">
                                    <a href="{{route('sort_hot_topic')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Chuyên đề nổi bật' : 'Sort topic'}}</p>
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{route('form_topic',0)}}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Thêm mới' : 'Add new'}}</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                @endif --}}
                @if (Auth::user()->level < 3 )
                    <li class="nav-item has-treeview">
                        <a href="{{ asset('admin') }}" class="nav-link @if (Request::segment(2) == 'video' || Request::segment(2) == 'group_video') active @endif">
                            <i class="nav-icon fas fa-video"></i>
                            <p>
                                {{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Video' : 'Video'}}
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin_video_group')}}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Danh mục video' : 'Video category'}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin_video')}}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Danh sách video' : 'Video listing'}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('form_video',0)}}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Thêm video' : 'Add new'}}</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if ( Auth::user()->level < 4)
                    <li class="nav-item has-treeview">
                        <a href="{{ asset('admin') }}" class="nav-link @if (Request::segment(2) == 'advert') active @endif">
                            <i class="nav-icon fas fa-paper-plane"></i>
                            <p>
                                {{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Quảng cáo' : 'Advertisement'}}
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ asset('admin/advert/add') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Thêm mới' : 'Add new'}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ asset('admin/advert') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Quản trị' : 'Advertisement list'}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ asset('admin/advert/top') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Sắp xếp' : 'Sort advertisement'}}</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->site == 1)
                    <li class="nav-item has-treeview">
                        <a href="{{ asset('admin') }}" class="nav-link @if (Request::segment(2) == 'emagazine') active @endif">
                            <i class="nav-icon fas fa-palette"></i>
                            <p>
                                {{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Emagazine' : 'Emagazine'}}
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ asset('admin/emagazine/add') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Thêm mới' : 'Add new'}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ asset('admin/emagazine') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Quản trị' : 'Emagazine list'}}</p>
                                </a>
                            </li>
                            @if (Auth::user()->level < 3)
                                <li class="nav-item">
                                    <a href="{{ asset('admin/emagazine/sort') }}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Sắp xếp' : 'Sort emagazine'}}</p>
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </li>


                @endif
                @if(Auth::user()->level < 3)
                    <li class="nav-item has-treeview">
                        <a href="{{ asset('admin') }}" class="nav-link @if (Request::segment(2) == 'magazine') active @endif">
                            <i class="nav-icon fas fa-book-open"></i>
                            <p>
                                {{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Tạp chí thường kì' : 'Journal'}}
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ asset('admin/magazine/add') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Thêm mới' : 'Add new'}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ asset('admin/magazine') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Danhn sách' : 'Journal list'}}</p>
                                </a>
                            </li>
                            @if (Auth::user()->level < 3)
                                <li class="nav-item">
                                    <a href="{{ asset('admin/magazine/sort') }}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Sắp xếp' : 'Sort journal'}}</p>
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif
                @if (Auth::user()->level < 4 && Auth::user()->site == 1)
                    <li class="nav-item has-treeview">
                        <a href="{{ asset('admin/comment') }}" class="nav-link @if (Request::segment(2) == 'comment') active @endif">
                            <i class="nav-icon fas fa-comments"></i>
                            <p>
                                {{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Quản trị bình luận' : 'Comment '}}
                            </p>
                        </a>
                    </li>

                    {{-- <li class="nav-item has-treeview">
                        <a href="{{ asset('admin/magazine') }}" class="nav-link  @if (Request::segment(2) == 'magazine') active @endif">
                            <i class="nav-icon fas fa-book-open"></i>
                            <p>
                                Quản lý tạp chí
                            </p>
                        </a>
                    </li> --}}
                @endif

                @if (Auth::user()->level<3 && Auth::user()->site == 1)
                    <li class="nav-item has-treeview">
                        <a href="{{ asset('admin/contact/contact') }}" class="nav-link @if (Request::segment(3) == 'contact') active @endif">
                            <i class="nav-icon fas fa-bell"></i>
                            <p>
                                {{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Liên hệ quảng cáo' : 'Contact advertising '}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{ asset('admin/contact/order') }}" class="nav-link @if (Request::segment(3) == 'order') active @endif">
                            <i class="nav-icon fas fa-check-circle"></i>
                            <p>
                                {{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Đặt mua báo' : 'Magazines subcription '}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview {{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? '' : 'd-none '}}">
                        <a href="{{ asset('admin/articel/form_articel/11994') }}" class="nav-link @if (Request::segment(2) == 'about') active @endif">
                            <i class="nav-icon fas fa-broadcast-tower"></i>
                            <p>
                                {{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Giới thiệu' : 'Introduce'}}
                            </p>
                        </a>
                    </li>


                @endif
                <li class="nav-item has-treeview">
                    <a href="{{ asset('admin/website_info') }}" class="nav-link @if (Request::segment(2) == 'website_info') active @endif">
                        <i class="nav-icon fas fa-info-circle"></i>
                        <p>
                            {{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Thông tin website' : 'Website information '}}
                        </p>
                    </a>
                </li>

                
                <li class="nav-item has-treeview">
                    <a href="{{ asset('admin') }}" class="nav-link @if (Request::segment(2) == 'report') active @endif">
                        <i class="nav-icon far fa-flag"></i>
                        <p>
                            {{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Thống kê' : 'Statistical '}}
                            <i class="nav-icon fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{Auth::user()->level < 3 ? route('report_article') : route('detail_report_article',Auth::user()->id)}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>{{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Thống kê bài viết' : 'Statistics articles '}}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                


                <li class="nav-item has-treeview">
                    <a href="{{ asset('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            {{\Illuminate\Support\Facades\Config::get('app.locale') == 'vn' ? 'Đăng xuất' : 'Logout '}}
                        </p>
                    </a>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>