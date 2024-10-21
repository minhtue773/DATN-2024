 <!-- Sidebar -->
 <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.home') }}">
        <img class="img-fluid" src="{{ asset('img/logo/logo.png') }}" alt="">
    </a>
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <span class="nav-link">Bảng điều khiển</span>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHome"
            aria-expanded="true" aria-controls="collapseHome">
            <i class="bi bi-house-add-fill"></i>
            <span>Nội dung trang chủ</span>
        </a>
        <div id="collapseHome" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('admin.banner.index')}}">Banner</a>
                <a class="collapse-item" href="{{route('admin.promotion.index')}}">Khuyến mãi</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.user.index')}}">
            <i class="fa fa-users"></i>
            <span>Quản lý tài khoản</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct"
            aria-expanded="true" aria-controls="collapseProduct">
            <i class="fa-brands fa-codepen"></i>
            <span>Quản lý sản phẩm</span>
        </a>
        <div id="collapseProduct" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.category.index') }}">Danh mục</a>
                <a class="collapse-item" href="{{ route('admin.product.index') }}">Sản phẩm</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseBlog"
            aria-expanded="true" aria-controls="collapseBlog">
            <i class="fa-regular fa-newspaper"></i>
            <span>Quản lý bài viết</span>
        </a>
        <div id="collapseBlog" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.post-category.index') }}">Chuyên mục</a>
                <a class="collapse-item" href="{{route('admin.post.index')}}">Bài viết</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('admin.comment.index')}}">
            <i class="bi bi-chat-quote-fill"></i>
            <span>Quản lý bình luận</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOder"
            aria-expanded="true" aria-controls="collapseOder">
            <i class="bi bi-box-seam-fill"></i>
            <span>Quản lý đơn hàng</span>
        </a>
        <div id="collapseOder" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('admin.order.index')}}">Đơn hàng</a>
                <a class="collapse-item" href="#">Quản lý giao dịch</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.trash') }}">
            <i class="bi bi-trash"></i>
            <span>Thùng rác</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>