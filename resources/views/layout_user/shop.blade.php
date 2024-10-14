@include('layout_user.menu')
<div class="breadcrumbs-section plr-200 mb-80">
    <div class="breadcrumbs overlay-bg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="breadcrumbs-inner">
                        <h1 class="breadcrumbs-title">Xem Sản Phẩm Dạng Lưới</h1>
                        <ul class="breadcrumb-list">
                            <li><a href="index.html">Trang Chủ</a></li>
                            <li>Sản Phẩm</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMBS SETCTION END -->

<!-- Start page content -->
<div id="page-content" class="page-wrapper">

    <!-- SHOP SECTION START -->
    <div class="shop-section mb-80">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-md-push-3 col-sm-12">
                    <div class="shop-content">
                        <!-- shop-option start -->
                        <div class="shop-option box-shadow mb-30 clearfix">
                            <!-- Nav tabs -->
                            <ul class="shop-tab f-left" role="tablist">
                                <li class="active">
                                    <a href="#grid-view" data-toggle="tab"><i class="zmdi zmdi-view-module"></i></a>
                                </li>
                                <li>
                                    <a href="#list-view" data-toggle="tab"><i class="zmdi zmdi-view-list-alt"></i></a>
                                </li>
                            </ul>
                            <!-- short-by -->
                            <div class="short-by f-left text-center">
                                <span>Sắp xếp theo:</span>
                                <select id="sort-select" onchange="changeSort()">
                                    <option value="newest" {{ request('sort_by') == 'newest' ? 'selected' : '' }}>Sản phẩm
                                        mới nhất</option>
                                    <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>
                                        Giá từ thấp đến cao</option>
                                    <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>
                                        Giá từ cao đến thấp</option>
                                    <option value="name_asc" {{ request('sort_by') == 'name_asc' ? 'selected' : '' }}>Tên
                                        A-Z</option>
                                    <option value="name_desc" {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>
                                        Tên Z-A</option>
                                </select>
                            </div>

                            <!-- showing -->
                            <div class="showing f-right text-right">
                                <span>Đang hiển thị: 01-09</span>
                            </div>
                        </div>
                        <!-- shop-option end -->
                        <!-- Tab Content start -->
                        <div class="tab-content">
                            <!-- grid-view -->
                            <div role="tabpanel" class="tab-pane active" id="grid-view">
                                <div class="row">
                                    @yield('list_sanpham')
                                </div>
                            </div>
                            <!-- list-view -->
                            <div role="tabpanel" class="tab-pane" id="list-view">
                                <div class="row">
                                    @yield('san_pham_ngang')

                                </div>
                            </div>
                        </div>
                        <!-- Tab Content end -->
                        <!-- shop-pagination start -->
                        <ul class="shop-pagination box-shadow text-center ptblr-10-30">
                            {{ $products->links('vendor.pagination.custom-pagination') }}
                        </ul>
                        <!-- shop-pagination end -->
                    </div>
                </div>


                <div class="col-md-3 col-md-pull-9 col-sm-12">
                    <!-- widget-search -->
                    <aside class="widget-search mb-30">
                        <form action="{{ route('products.index') }}" method="GET">
                            <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..."
                                value="{{ request('search') }}">
                            <button type="submit"><i class="zmdi zmdi-search"></i></button>
                        </form>
                    </aside>

                    <!-- widget-categories -->
                    <aside class="widget widget-categories box-shadow mb-30">
                        <h6 class="widget-title border-left mb-20">Danh mục</h6>
                        <div id="cat-treeview" class="product-cat">
                            <ul>
                                @yield('danh_muc')
                            </ul>
                        </div>
                    </aside>

                    <!-- shop-filter -->
                    <aside class="widget shop-filter box-shadow mb-30">
                        <h6 class="widget-title border-left mb-20">Giá</h6>
                        <div id="cat-treeview" class="product-cat">
                            <ul>
                                <li class="{{ request('price_range') == 'under_1m' ? 'open' : 'closed' }}">
                                    <a
                                        href="{{ route('products.index', ['price_range' => 'under_1m', 'category_id' => request('category_id'), 'sort_by' => request('sort_by')]) }}">
                                        Dưới 1.000.000 VND
                                    </a>
                                </li>
                                <li class="{{ request('price_range') == '1m_to_2m' ? 'open' : 'closed' }}">
                                    <a
                                        href="{{ route('products.index', ['price_range' => '1m_to_2m', 'category_id' => request('category_id'), 'sort_by' => request('sort_by')]) }}">
                                        Từ 1.000.000 đến 2.000.000 VND
                                    </a>
                                </li>
                                <li class="{{ request('price_range') == '2m_to_5m' ? 'open' : 'closed' }}">
                                    <a
                                        href="{{ route('products.index', ['price_range' => '2m_to_5m', 'category_id' => request('category_id'), 'sort_by' => request('sort_by')]) }}">
                                        Từ 2.000.000 đến 5.000.000 VND
                                    </a>
                                </li>
                                <li class="{{ request('price_range') == '5m_to_10m' ? 'open' : 'closed' }}">
                                    <a
                                        href="{{ route('products.index', ['price_range' => '5m_to_10m', 'category_id' => request('category_id'), 'sort_by' => request('sort_by')]) }}">
                                        Từ 5.000.000 đến 10.000.000 VND
                                    </a>
                                </li>
                                <li class="{{ request('price_range') == 'above_10m' ? 'open' : 'closed' }}">
                                    <a
                                        href="{{ route('products.index', ['price_range' => 'above_10m', 'category_id' => request('category_id'), 'sort_by' => request('sort_by')]) }}">
                                        Trên 10.000.000 VND
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </aside>

                    <!-- widget-color -->
                    <aside class="widget widget-color box-shadow mb-30">
                        <h6 class="widget-title border-left mb-20">Màu sắc</h6>
                        <ul>
                            <li class="color-1"><a href="#">Đỏ</a></li>
                            <li class="color-2"><a href="#">Xanh dương</a></li>
                            <li class="color-3"><a href="#">Xanh lá</a></li>
                            <li class="color-4"><a href="#">Vàng</a></li>
                            <li class="color-5"><a href="#">Đen</a></li>
                        </ul>
                    </aside>

                    <!-- widget-scale -->
                    <aside class="widget widget-scale box-shadow mb-30">
                        <h6 class="widget-title border-left mb-20">Tỷ lệ mô hình</h6>
                        <form action="action_page.php">
                            <label><input type="checkbox" name="scale" value="1-24">1:24</label><br>
                            <label><input type="checkbox" name="scale" value="1-48">1:48</label><br>
                            <label><input type="checkbox" name="scale" value="1-72">1:72</label><br>
                            <label><input type="checkbox" name="scale" value="1-144">1:144</label><br>
                        </form>
                    </aside>

                    <!-- widget-product -->
                    <aside class="widget widget-product box-shadow">
                        <h6 class="widget-title border-left mb-20">Sản phẩm mới</h6>
                        @yield('san_pham_moi')
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- SHOP SECTION END -->
    <div id="quickview-wrapper">
        <!-- Modal -->
        @yield('quickview')
        <!-- END Modal -->
    </div>

</div>

@include('layout_user.footer')