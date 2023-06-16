@php use App\Models\User;use Illuminate\Support\Facades\Auth; @endphp
<div class="sidebar" data-image="{{asset('/assets/img/sidebar-5.jpg')}}">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="http://www.creative-tim.com" class="simple-text">
                Order Shopping Mall
            </a>
        </div>
        <ul class="nav">
            <li class="nav-item active">
                <a class="nav-link" href="/">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>Bảng tin</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="/search-product">
                    <i class="nc-icon nc-zoom-split"></i>
                    <p>Đặt hàng</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="">
                    <i class="nc-icon nc-circle-09"></i>
                    <p>Quản lý Đơn hàng</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="">
                    <i class="nc-icon nc-paper-2"></i>
                    <p>Quản lý ví tiền</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="icons.html">
                    <i class="nc-icon nc-atom"></i>
                    <p>Cấu hình tài khoản</p>
                </a>
            </li>
            @php
                $user = User::find(Auth::user()->id);
                $roles = $user->roles;
                $isAdmin = false;
                for ($i = 0; $i<count($roles);$i++){
                    if($roles[$i]->name == \App\Enums\Role::ADMIN){
                        $isAdmin = true;
                    }
                }
            @endphp
            @if($isAdmin)
                <li>
                    <div class="nav-link dropdown">
                        <i class="nc-icon nc-paper-2"></i>
                        <a class="dropdown-toggle" data-toggle="dropdown">Quản lý kho hàng</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{route('warehouse.index')}}">Danh sách kho hàng đã tạo</a>
                            <a class="dropdown-item" href="{{route('warehouse.processCreate')}}">Thêm mới kho hàng</a>
                        </div>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</div>
