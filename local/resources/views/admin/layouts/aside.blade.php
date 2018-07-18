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
          <img src="{{ asset('local/storage/app/avatar/resized-'.Auth::user()->img) }}" class="img-circle elevation-2" alt="User Image">
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
                Thống kê
              </p>
            </a>
          </li>
          @if (Auth::user()->level < 3)
            <li class="nav-item has-treeview">
              <a href="{{ asset('admin/') }}" class="nav-link @if (Request::segment(2) == 'account') active @endif"">
                <i class="fas fa-users-cog nav-icon"></i>
                <p>
                  Quản lí tài khoản
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ asset('admin/account') }}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>Danh sách tài khoản</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ asset('admin/account/add') }}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>Thêm mới</p>
                  </a>
                </li>
                
              </ul>
            </li>
          @endif
          
          <li class="nav-item has-treeview">
            <a href="{{ asset('admin/') }}" class="nav-link @if (Request::segment(2) == 'user') active @endif"">
              <i class="fas fa-user-shield nav-icon"></i>
              <p>
                Cá Nhân
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ asset('admin/profile') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Thông tin cá nhân</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ asset('admin/profile/change_pass') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Đổi mật khẩu</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-ellipsis-h"></i>
              <p>
                Danh mục
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/tables/simple.html" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Sắp xếp</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/data.html" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Thêm danh mục</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link @if (Request::segment(2) == 'news') active @endif"">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>
                Quản trị tin
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/UI/general.html" class="nav-link">
                  <i class="fa fa-circle-o nav-icon text-warning"></i>
                  <p>Bài chờ duyệt</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/icons.html" class="nav-link">
                  <i class="fa fa-circle-o nav-icon text-info"></i>
                  <p>Bài đã duyệt</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/buttons.html" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Viết bài</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-video"></i>
              <p>
                Video
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/tables/simple.html" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Video đã duyệt</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/data.html" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Video chờ duyệt</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/data.html" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Thêm video</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-paperclip"></i>
              <p>
                Quản trị tin tiêu điểm
              </p>
            </a>
            
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-paper-plane"></i>
              <p>
                Quảng cáo
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ asset('admin/advert/add') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Thêm mới</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ asset('admin/advert') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Quản trị</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ asset('admin/advert/top') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Sắp xếp</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ asset('admin') }}" class="nav-link">
              <i class="nav-icon fas fa-comments"></i>
              <p>
                Quản trị bình luận
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ asset('logout') }}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Đăng xuất
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>