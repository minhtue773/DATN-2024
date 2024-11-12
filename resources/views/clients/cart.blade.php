@extends('clients.layout.app')
@section('title')
    Giỏ Hàng
@endsection
@section('content')
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Giỏ Hàng</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="/">Trang Chủ</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Giỏ Hàng</p>
            </div>
        </div>
    </div>
    <div class="container-fluid pt-5" ng-controller="siteController">
        <div style="box-shadow: 0px 0px 2px rgba(0, 0, 0, 0.1);padding: 20px;background-color: #fff;flex: 1; border-radius: 8px;"
            ng-if="cart.length==0">
            <div class="cart-empty body-mh-300" style="justify-content: center;display: flex;align-items: center;">
                <div style="text-align: center">
                    <div class="icon-empty-cart"><img
                            src="https://cdn0.fahasa.com/skin//frontend/ma_vanese/fahasa/images/checkout_cart/ico_emptycart.svg"
                            class="center"></div>
                    <p style="font-size:14px;margin: 20px 0;">Chưa có sản phẩm trong giỏ hàng của bạn.</p>

                    <a style="color: white;text-transform: uppercase;" href="{{ route('products.index') }}">
                        <button class="btn btn-primary px-3" type="button" title="Mua sắm ngay" style="margin:auto">Mua sắm
                            ngay
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <div class="row px-xl-5" ng-if="cart.length>0">
            <div class="col-lg-8 table-responsive mb-5" style="max-height: 500px; overflow-y: auto;">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Sản Phẩm</th>
                            <th>Giá</th>
                            <th>Số Lượng</th>
                            <th>Tổng Tiền</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <tr ng-repeat="sp in cart" ng-cloak>
                            <td class="align-middle">
                                <div class="d-flex align-items-center ml-3">
                                    <a href="/product/%% sp.slug %%">
                                        <img src="{{ asset('uploads/images/product/%% sp.hinh %%') }}" alt=""
                                            style="width: 70px;" class="img-fluid mr-3">
                                    </a> <a href="/product/%% sp.slug %%">
                                        %% sp.name %%
                                    </a>
                                </div>
                            </td>
                            <td class="align-middle"><span ng-if="sp.sale > 0">
                                    <span>%% sp.price | customNumber:0 %% đ</span>
                                </span>


                                <span ng-if="!sp.sale || sp.sale == 0">
                                    {{-- %% sp.original_price | customNumber:0 %% đ --}}
                                    <span>%% sp.price | customNumber:0 %% đ</span>
                                </span>
                            </td>
                            <td class="align-middle">

                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" ng-click="decreaseQuantity(sp.id)">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>

                                    <input type="number" ng-model="sp.soluong" ng-blur="updateQuantity(sp.id, sp.soluong)"
                                        name="quantity" oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                        onkeydown="if(['-', '+', 'e'].includes(event.key)) event.preventDefault();"
                                        class="form-control form-control-sm bg-secondary text-center quantity-input" />

                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus" ng-click="increaseQuantity(sp.id)">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>


                            </td>
                            <td class="align-middle"> %% sp.soluong *
                                ((sp.price!=null)?sp.price:sp.price)| customNumber:0 %% đ</td>
                            <td class="align-middle"><button class="btn btn-sm btn-primary"
                                    ng-click="removeFromCart($index)"><i class="fa fa-times"></i></button></td>
                        </tr>


                    </tbody>

                </table>


            </div>
         
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Tóm tắt giỏ hàng</h4>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="">Tổng Giỏ Hàng</h5>
                            <h5 class="" ng-cloak>%% totalCartMoney()|customNumber:0
                                %% đ</h5>
                        </div>
                        <form>
                            <button class="btn btn-block btn-primary my-3 py-3" ng-click="checkout()">Thanh toán</button>

                        </form>
                    </div>
                </div>
            </div>

            <div style="margin-left: 60%">
                <button class="btn btn-primary px-3" style="float: right; margin-top: 3%" ng-click="clearCart()"><i class="fas fa-trash"></i> xóa
                    hết</button>
            </div>
        </div>
    </div>

@section('viewFunction')
    <script>
        viewFunction = function($scope, $http) {

            $scope.updateQuantity = function(id, soluong) {
                const product = $scope.cart.find(item => item.id === id);

                if (!product) return;

                // Kiểm tra số lượng không được nhỏ hơn hoặc bằng 0
                if (soluong <= 0) {
                    product.soluong = 1; // Cập nhật lại số lượng thành 1
                    soluong = 1;
                    Swal.fire('Thông báo', 'Số lượng không thể nhỏ hơn 1. Số lượng đã được đặt lại thành 1.',
                        'warning');
                }

                // Kiểm tra số lượng không được lớn hơn stock
                if (soluong > product.stock) {
                    product.soluong = product.stock;
                    soluong = product.stock; // Đặt số lượng bằng stock
                    Swal.fire('Thông báo', 'Số lượng đã vượt quá tồn kho. Số lượng đã được đặt lại thành ' + product
                        .stock + '.', 'warning');
                }

                // Gọi API để cập nhật số lượng
                $http.patch('/api/cart/' + id, {
                        soluong: soluong
                    })
                    .then(function(response) {
                        console.log(response.data.message);
                    }, function(error) {
                        console.error("Lỗi khi cập nhật số lượng:", error);
                    });
            };

            // Hàm giảm số lượng
            $scope.decreaseQuantity = function(id) {
                const product = $scope.cart.find(item => item.id === id);
                if (product && product.soluong > 1) {
                    product.soluong--;
                    $scope.updateQuantity(id, product.soluong);
                } else if (product) {
                    Swal.fire('Thông báo', 'Số lượng không thể nhỏ hơn 1.', 'warning');
                    product.soluong = 1;
                }
            };

            // Hàm tăng số lượng
            $scope.increaseQuantity = function(id) {
                const product = $scope.cart.find(item => item.id === id);
                if (product) {
                    if (product.soluong < product.stock) {
                        product.soluong++;
                    } else {
                        Swal.fire('Thông báo', 'Số lượng đã đạt tối đa tồn kho.', 'warning');
                        product.soluong = product.stock; // Không cho tăng quá stock
                    }
                    $scope.updateQuantity(id, product.soluong);
                }
            };



            $scope.checkout = function() {
                $http.post('/api/checkout').then(function(res) {
                    // Sau khi cập nhật session cart, chuyển hướng tới trang thanh toán
                    window.location.href = '/checkout';
                }).catch(function(error) {
                    console.error('Lỗi khi kiểm tra giỏ hàng:', error);
                    Swal.fire('Lỗi!', 'Có lỗi xảy ra khi kiểm tra giỏ hàng.', 'error');
                });
            };

        }
    </script>
@endsection

@endsection
