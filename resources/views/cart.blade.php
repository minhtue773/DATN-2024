@include('layout_user.menu')

@section('tieude')
    Cart
@endsection
<div class="breadcrumbs-section plr-200 mb-80">
    <div class="breadcrumbs overlay-bg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="breadcrumbs-inner">
                        <h1 class="breadcrumbs-title">Giỏ Hàng</h1>
                        <ul class="breadcrumb-list">
                            <li><a href="index.html">Home</a></li>
                            <li>Login / Register</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section id="page-content" class="page-wrapper">

    <!-- SHOP SECTION START -->
    <div class="shop-section mb-80" ng-controller="siteController">
        <div class="container" >
            <div class="row" ng-if="cart.length>0">

                <div class="col-md-12">
                    <!-- Tab panes -->
                    <div>
                        <!-- shopping-cart start -->
                        <div class="tab-pane">
                            <div class="shopping-cart-content">
                                <form action="#">
                                    <div class="table-content table-responsive mb-50">
                                        <table class="text-center">
                                            <thead>
                                                <tr>
                                                    <th class="product-thumbnail">sản phẩm</th>
                                                    <th class="product-price">giá</th>
                                                    <th class="product-quantity">Số lượng</th>
                                                    <th class="product-subtotal">tổng cộng</th>
                                                    <th class="product-remove">xóa</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="sp in cart">
                                                    <td class="product-thumbnail">
                                                        <div class="pro-thumbnail-img">
                                                            <a href="/product/%% sp.id %%">
                                                                <img ng-src="{{ asset('%% sp.hinh %%') }}"
                                                                    alt="">

                                                            </a>
                                                        </div>
                                                        <div class="pro-thumbnail-info text-left">
                                                            <h6 class="product-title-2">
                                                                <a href="/product/%% sp.id %%">
                                                                    %% sp.name %%
                                                                </a>
                                                            </h6>
                                                            <p>Thương hiệu: %% sp.category_name %%</p>
                                                           
                                                        </div>
                                                    </td>
                                                    <td class="product-price">
                                                      <!-- Nếu sale lớn hơn 0, hiển thị cả giá gốc và giá đã giảm -->
                                                      <span ng-if="sp.sale > 0">
                                                          <!-- Giá cũ có gạch ngang -->
                                                          <del>%% sp.original_price | customNumber:0 %% đ</del> 
                                                          <br> 
                                                          <!-- Giá sau khi giảm -->
                                                          <span>%% sp.price | customNumber:0 %% đ</span>
                                                      </span>
                                                  
                                                      <!-- Nếu sale bằng 0 hoặc null, chỉ hiển thị giá gốc (giá hiện tại) -->
                                                      <span ng-if="!sp.sale || sp.sale == 0">
                                                          %% sp.original_price | customNumber:0 %% đ
                                                      </span>
                                                  </td>
                                                  
                                                  

                                                    <td class="product-quantity">
                                                        <div class="cart-plus-minus f-left" style="margin-left: 23%">
                                                            <input type="number" name="quantity" ng-model="sp.soluong"
                                                                min="1" max="%% sp.stock %%"
                                                                ng-change="updateQuantity(sp.id, sp.soluong)"
                                                                class="cart-plus-minus-box">
                                                        </div>
                                                    </td>
                                                    <td class="product-subtotal">%% sp.soluong *
                                                      ((sp.price!=null)?sp.price:sp.price)| customNumber:0 %% đ</td>

                                                    <td class="product-remove">
                                                        <a href="#" style="margin-left: 30%"
                                                            ng-click="removeFromCart($index)"><i
                                                                class="zmdi zmdi-close"></i></a>
                                                    </td>
                                                </tr>


                                            </tbody>
                                            
                                        </table>
                                     
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="coupon-discount box-shadow p-30 mb-50">
                                                <h6 class="widget-title border-left mb-20">mã giảm giá</h6>
                                                <p>Nhập mã giảm giá của bạn nếu có!</p>
                                                <input type="text" name="name"
                                                    placeholder="Nhập mã của bạn ở đây.">
                                                <button class="submit-btn-1 black-bg btn-hover-2" type="submit">áp dụng
                                                    mã giảm giá</button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="payment-details box-shadow p-30 mb-50">
                                                <h6 class="widget-title border-left mb-20">chi tiết thanh toán
                                                </h6>
                                                <table>
                                                   
                                                    <tr>
                                                        <td class="order-total">Tổng giỏ hàng</td>
                                                        <td class="order-total-price">%% totalCartMoney()|customNumber:0 %% đ</td>
                                                       
                                                    </tr>
                                                   
                                                </table>
                                            </div>
                                            <button class="submit-btn-1 black-bg btn-hover-2" type="submit">Checkout</button>
                                        </div>
                                    </div>
                 
                    </div>
                </div>
            </div>

            <div ng-if="cart.length==0">
                  huuthien
            </div>
        </div>
        
        
    </div>
    <!-- SHOP SECTION END -->

</section>




@section('viewFunction')
    <script>
        viewFunction = function($scope, $http) {
           
            $scope.updateQuantity = function(id, soluong) {
                $http.patch('/api/cart/' + id, {
                    soluong: soluong
                }).then(
                    function(res) {

                    }
                );
            }
        }
    </script>
@endsection

@include('layout_user.footer')
