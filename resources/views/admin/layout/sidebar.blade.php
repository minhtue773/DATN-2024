 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa-solid fa-face-grin-tongue-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">HobbyZone</div>
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
                <a class="collapse-item" href="{{route('admin.product.trash')}}">Thùng rác <span class="badge badge-danger ms-1">3</span></a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBlog"
            aria-expanded="true" aria-controls="collapseBlog">
            <i class="fa-regular fa-newspaper"></i>
            <span>Quản lý bài viết</span>
        </a>
        <div id="collapseBlog" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="#">Chuyên mục</a>
                <a class="collapse-item" href="{{route('admin.blog.index')}}">Bài viết</a>
                <a class="collapse-item" href="#">Thùng rác <span class="badge badge-danger ms-1">3</span></a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseComment"
            aria-expanded="true" aria-controls="collapseComment">
            {{-- <i class="fa-regular fa-newspaper"></i> --}}
            <i class="bi bi-chat-quote-fill"></i>
            <span>Quản lý bình luận</span>
        </a>
        <div id="collapseComment" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('admin.comment.index')}}">Bình luận</a>
                <a class="collapse-item" href="#">Thùng rác <span class="badge badge-danger ms-1">3</span></a>
            </div>
        </div>
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
                <a class="collapse-item" href="#">Thùng rác <span class="badge badge-danger ms-1">3</span></a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>