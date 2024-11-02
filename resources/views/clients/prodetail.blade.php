@extends('clients.layout.app')
@section('title')
@endsection
@section('content')
    @if (isset($sp))
        <div ng-controller="siteController" ng-init="currentUserId={{ Auth::id() }}">
            <div class="container-fluid bg-secondary mb-5">
                <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
                    <h1 class="font-weight-semi-bold text-uppercase mb-3">Chi Tiết Mô Hình</h1>
                    <div class="d-inline-flex">
                        <p class="m-0"><a href="">Trang Chủ</a></p>
                        <p class="m-0 px-2">-</p>
                        <p class="m-0">Chi Tiết Mô Hình</p>
                    </div>
                </div>
            </div>

            <div class="container-fluid py-5">
                <div class="row px-xl-5">
                    <div class="col-lg-5 pb-5">
                        <div id="product-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner border">

                                <div class="carousel-item active">
                                    @if ($sp->discount > 0)
                                        <div class="sale-notice"
                                            style="position: absolute; top: 10px; left: 10px; background: red; color: white; padding: 5px; border-radius: 3px;">
                                            Sale {{ $sp->discount }}%
                                        </div>
                                    @endif
                                    <img class="w-100 h-100" src="{{ asset('client/' . $sp->image) }}" alt="Image">

                                </div>

                                @foreach ($images as $hinh)
                                    @if ($sp->discount > 0)
                                        <div class="sale-notice"
                                            style="position: absolute; top: 10px; left: 10px; background: red; color: white; padding: 5px; border-radius: 3px;">
                                            Giảm {{ $sp->discount }}%
                                        </div>
                                    @endif
                                    <div class="carousel-item">
                                        <img class="w-100 h-100" src="{{ asset('client/' . $hinh->image) }}" alt="Image">
                                    </div>
                                @endforeach


                            </div>
                            <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                                <i class="fa fa-2x fa-angle-left text-dark"></i>
                            </a>
                            <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                                <i class="fa fa-2x fa-angle-right text-dark"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-7 pb-5">
                        <h3 class="font-weight-semi-bold">{{ $sp->name }}</h3>
                        <p class="text-dark font-weight-medium mb-0 mr-3" style="margin-top: 2%">Danh Mục:
                            {{ $categoryName }}</p>
                        @if ($sp->stock == 0)
                            <p class="text-dark font-weight-medium mb-0 mr-3" style="margin-top: 1%">Tình Trạng: Hết Hàng
                            </p>
                        @else
                            <p class="text-dark font-weight-medium mb-0 mr-3" style="margin-top: 1%">Tình Trạng: Còn Hàng
                            </p>
                        @endif



                        <div class="d-flex mb-3" style="margin-top: 1%">
                            <div class="text-primary mr-2">
                                <i class="fas fa-star" ng-show="average_rating >= 1"></i>
                                <i class="fas fa-star" ng-show="average_rating >= 2"></i>
                                <i class="fas fa-star" ng-show="average_rating >= 3"></i>
                                <i class="fas fa-star" ng-show="average_rating >= 4"></i>
                                <i class="fas fa-star" ng-show="average_rating >= 5"></i>


                                <i class="far fa-star" ng-show="average_rating < 5"></i>
                                <i class="far fa-star" ng-show="average_rating < 4"></i>
                                <i class="far fa-star" ng-show="average_rating < 3"></i>
                                <i class="far fa-star" ng-show="average_rating < 2"></i>
                                <i class="far fa-star" ng-show="average_rating < 1"></i>
                            </div>
                            <small class="pt-1">(%% totalComments || 0 %% Đánh giá)</small>

                        </div>

                        @if ($sp->discount > 0)
                            <h3 class="font-weight-semi-bold mb-4" style="text-decoration: line-through;">
                                {{ number_format($sp->price, 0, ',', '.') }} đ
                            </h3>
                            <h3 class="font-weight-semi-bold mb-4">
                                {{ number_format($salePrice, 0, ',', '.') }} đ
                            </h3>
                        @else
                            <h3 class="font-weight-semi-bold mb-4">
                                {{ number_format($sp->price, 0, ',', '.') }} đ
                            </h3>
                        @endif



                        <div class="d-flex align-items-center mb-4 pt-2">
                            <div class="input-group quantity mr-3" style="width: 130px;">

                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-minus" ng-click="decreaseQty()">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" id="quantityInput" ng-model="quantity" ng-change="validateQuantity()"
                                    min="1" max="{{ $sp->stock }}" class="form-control" />



                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-plus" ng-click="increaseQty()">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            @if ($sp->stock == 0)
                                <button class="btn btn-primary px-3" disabled>Hết hàng</button>
                            @else
                                <button class="btn btn-primary px-3"
                                    ng-click="addToCart2({{ $sp->id }}, quantity)"><i
                                        class="fa fa-shopping-cart mr-1"></i> Thêm Vào Giỏ Hàng</button>
                            @endif

                        </div>
                        <div class="d-flex pt-2">
                            <p class="text-dark font-weight-medium mb-0 mr-2">Chia Sẻ Lên:</p>
                            <div class="d-inline-flex">
                                <a class="text-dark px-2" href="">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a class="text-dark px-2" href="">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a class="text-dark px-2" href="">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a class="text-dark px-2" href="">
                                    <i class="fab fa-pinterest"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row px-xl-5">
                    <div class="col">
                        <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                            <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Mô Tả</a>
                            <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Thông Tin</a>
                            <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Đánh Giá (%% totalComments
                                || 0 %% )</a>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-pane-1">
                                <h4 class="mb-3">Mô Tả Sản Phẩm</h4>
                                <p>{{ $sp->description }}</p>

                            </div>
                            <div class="tab-pane fade" id="tab-pane-2">
                                <h4 class="mb-3">Additional Information</h4>
                                <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam
                                    invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod
                                    consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum
                                    diam.
                                    Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing,
                                    eos
                                    dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod
                                    nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt
                                    tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item px-0">
                                                Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                            </li>
                                            <li class="list-group-item px-0">
                                                Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                            </li>
                                            <li class="list-group-item px-0">
                                                Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                            </li>
                                            <li class="list-group-item px-0">
                                                Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item px-0">
                                                Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                            </li>
                                            <li class="list-group-item px-0">
                                                Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                            </li>
                                            <li class="list-group-item px-0">
                                                Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                            </li>
                                            <li class="list-group-item px-0">
                                                Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-pane-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mb-4">%% totalComments || 0 %% đánh giá cho "{{ $sp->name }}"
                                        </h4>
                                        <div class="media mb-4" ng-repeat="bl in dsBL">
                                            <img src="{{ asset('client') }}/img/user.jpg" alt="Image"
                                                class="img-fluid mr-3 mt-1" style="width: 45px;">
                                            <div class="media-body">
                                                <h6>%% bl.user_fullname %%<small> - <i>%% bl.created_at | date: 'dd/MM/yyyy
                                                            HH:mm:ss' %%</i></small>

                                                    <small ng-if="bl.user_id == currentUserId"><a
                                                            href="javascript:void(0);" ng-click="deleteComment(bl.id)">/
                                                            Xóa</a>
                                                    </small>
                                                </h6>
                                                <div class="text-primary mb-2">
                                                    <i class="fas fa-star" ng-show="bl.rating_stars >= 1"></i>
                                                    <i class="fas fa-star" ng-show="bl.rating_stars >= 2"></i>
                                                    <i class="fas fa-star" ng-show="bl.rating_stars >= 3"></i>
                                                    <i class="fas fa-star" ng-show="bl.rating_stars >= 4"></i>
                                                    <i class="fas fa-star" ng-show="bl.rating_stars >= 5"></i>

                                                    <i class="far fa-star" ng-show="bl.rating_stars < 5"></i>
                                                    <i class="far fa-star" ng-show="bl.rating_stars < 4"></i>
                                                    <i class="far fa-star" ng-show="bl.rating_stars < 3"></i>
                                                    <i class="far fa-star" ng-show="bl.rating_stars < 2"></i>
                                                    <i class="far fa-star" ng-show="bl.rating_stars < 1"></i>
                                                </div>
                                                <p>%% bl.content %%</p>
                                            </div>
                                        </div>
                                    </div>
                                    @auth
                                        <div class="col-md-6">
                                            <h4 class="mb-4">Để lại 1 đánh giá</h4>

                                            <div class="d-flex my-3">
                                                <div class="form-group">
                                                    <label for="userRating">Sao đánh giá</label>
                                                    <select ng-model="rating" class="form-control" id="rating">
                                                        <option value="5">5 sao</option>
                                                        <option value="4">4 sao</option>
                                                        <option value="3">3 sao</option>
                                                        <option value="2">2 sao</option>
                                                        <option value="1">1 sao</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <form>
                                                <div class="form-group">
                                                    <label for="message">Nội Dung Đánh giá</label>

                                                    <textarea id="message" cols="30" rows="5" class="form-control" ng-model="content"
                                                        placeholder="Nhập nội dung bình luận" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Tên của bạn</label>
                                                    <input type="text" class="form-control" id="name"
                                                        value="{{ Auth::user()->name }}" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email của bạn</label>
                                                    <input type="email" class="form-control" id="email"
                                                        value="{{ Auth::user()->email }}" readonly>
                                                </div>

                                                <div class="form-group mb-0">
                                                    <button class="btn btn-primary" ng-click="sendComment()">Gửi bình
                                                        luận</button>
                                                </div>



                                            </form>
                                        </div>
                                    @endauth
                                    @guest
                                        <h4 class="mb-4"><a href="/login">Đăng nhập để bình luận</a></h4>

                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid py-5">
                <div class="text-center mb-4">
                    <h2 class="section-title px-5"><span class="px-2">Mô Hình Liên Quan</span></h2>
                </div>
                <div class="row px-xl-5">
                    <div class="col">
                        <div class="owl-carousel related-carousel">
                            @foreach ($relatedProducts as $product)
                                <div class="card product-item border-0">
                                    <div
                                        class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                        <a href="{{ route('product.detail', ['id' => $product->id]) }}">
                                            <img class="img-fluid w-100" src="{{ asset('client/' . $product->image) }}"
                                                alt="{{ $product->name }}">
                                        </a>
                                    </div>
                                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                        <a href="{{ route('product.detail', ['id' => $product->id]) }}">
                                            <h6 class="text-truncate mb-3">{{ $product->name }}</h6>
                                        </a>
                                        <div class="d-flex justify-content-center">
                                            @if ($product->sale_price < $product->price)
                                                <h6 style="margin-right: 5%">
                                                    <del>{{ number_format($product->price, 0, ',', '.') }} đ</del>
                                                </h6>

                                                <h6>{{ number_format($product->sale_price, 0, ',', '.') }} đ</h6>
                                            @else
                                                <h6> {{ number_format($product->price, 0, ',', '.') }} đ</h6>
                                            @endif



                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between bg-light border">
                                        <a href="{{ route('product.detail', ['id' => $product->id]) }}"
                                            class="btn btn-sm text-dark p-0"><i
                                                class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                        @if ($product->stock == 0)
                                            <a href="javascript:void(0);" class="btn btn-sm text-dark p-0">Hết hàng</a>
                                        @else
                                            <a href="javascript:void(0);" class="btn btn-sm text-dark p-0"
                                                ng-click="addToCart({{ $sp->id }}, quantity)"><i
                                                    class="fas fa-shopping-cart text-primary mr-1"></i>Thêm vào giỏ
                                                hàng</a>
                                        @endif

                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

        </div>
        @section('viewFunction')
            <script>
                viewFunction = function($scope, $http) {
                    $scope.quantity = 1; // Khởi tạo số lượng

                    $scope.validateQuantity = function() {
                        // Kiểm tra giới hạn hợp lệ
                        if ($scope.quantity <= 0) {
                            $scope.quantity = 1;
                            alert("Số lượng không thể nhỏ hơn 1. Số lượng đã được đặt lại thành 1.");
                        } else if ($scope.quantity > {{ $sp->stock }}) {
                            $scope.quantity = {{ $sp->stock }};
                            alert("Số lượng đã đạt tối đa tồn kho. Số lượng đã được đặt lại thành " + $scope.quantity +
                                ".");
                        }

                        // Cập nhật lại giá trị của ô input trực tiếp
                        document.getElementById('quantityInput').value = $scope.quantity;
                    };

                    // Hàm giảm số lượng
                    $scope.decreaseQty = function() {
                        if ($scope.quantity > 1) {
                            $scope.quantity--;
                        } else {
                            alert("Số lượng không thể nhỏ hơn 1.");
                        }
                        $scope.validateQuantity();
                    };

                    // Hàm tăng số lượng
                    $scope.increaseQty = function() {
                        if ($scope.quantity < {{ $sp->stock }}) {
                            $scope.quantity++;
                        } else {
                            alert("Số lượng đã đạt tối đa tồn kho.");
                        }
                        $scope.validateQuantity();
                    };
                    $scope.dsBL = [];
                    $scope.getComment = function() {
                        $http.get('/api/comments/product/{{ $sp->id }}').then(
                            function(res) { // Thành công
                                $scope.dsBL = res.data.data; // Danh sách bình luận
                                $scope.totalComments = res.data.total_comments; // Số lượng bình luận
                                $scope.average_rating = res.data.average_rating;
                                console.log($scope.dsBL);
                                console.log("Tổng số bình luận: ", $scope.totalComments); // In ra số lượng bình luận
                            },
                            function(res) { // Thất bại
                                console.error('Lỗi khi lấy dữ liệu từ API', res);
                            }
                        );
                    };


                    $scope.getComment();

                    $scope.sendComment = function() {
                        $http.post('/api/comments', {
                            'product_id': {{ $sp->id }},
                            'content': $scope.content,
                            'rating': $scope.rating,
                        }).then(
                            function(res) {
                                if (res.data.status) {

                                    $scope.content = '';
                                    $scope.rating = 5;


                                    $scope.getComment();


                                    alert('Thêm bình luận thành công!');


                                }
                            },
                            function(error) {

                                alert('Có lỗi xảy ra: ' + error.data.message);

                            }
                        );
                    };


                    $scope.deleteComment = function(commentId) {
                        if (confirm("Bạn có chắc chắn muốn xóa bình luận này?")) {
                            $http.delete('/api/comments/' + commentId).then(
                                function(res) {
                                    if (res.data.status) {
                                        $scope.successMessage = res.data.message;
                                        $scope.getComment();
                                    }
                                },
                            );
                        }
                    };
                };
            </script>
        @endsection
    @else
        <div class="error-section mb-80" style="margin-left: 30%">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="error-404 box-shadow p-4"> <!-- Added p-4 class for Bootstrap padding -->
                            <img src="img/others/error.jpg" alt="" class="img-fluid">
                            <div class="go-to-btn btn-hover-2 mt-3"> <!-- Add margin-top for spacing -->
                                <h4>Sản Phẩm Không Tồn Tại Hoặc Bị Ẩn</h4>
                                <a href="/" class="btn btn-primary">Trở về trang chủ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif




@endsection
