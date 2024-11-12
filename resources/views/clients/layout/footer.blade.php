<!-- Footer Start -->
<div class="container-fluid bg-secondary text-dark mt-5 pt-5">
    <div class="row px-xl-5 pt-5">
        <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
            <a href="" class="text-decoration-none">
                <img src="{{ asset('uploads/images/logo/' . $settingsArray['img_logo']['setting_value']) }}"
                    alt="Logo" class="img-fluid w-50">
            </a>
            <p class="mt-3">{{ $settingsArray['description_company']['setting_value'] ?? 'Chưa được cập nhật' }}</p>
            <p class="mb-2"><i
                    class="fa fa-map-marker-alt text-primary mr-3"></i>{{ $settingsArray['address']['setting_value'] ?? 'Địa chỉ chưa được cập nhật' }}
            </p>
            <p class="mb-2"><i
                    class="fa fa-envelope text-primary mr-3"></i>{{ $settingsArray['email']['setting_value'] ?? 'Email chưa được cập nhật' }}
            </p>
            <p class="mb-0"><i
                    class="fa fa-phone-alt text-primary mr-3"></i>{{ $settingsArray['phone']['setting_value'] ?? '+012 345 67890' }}
            </p>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="row">
                <div class="col-md-4 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4">Hobby Zone</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-dark mb-2" href="/"><i class="fa fa-angle-right mr-2"></i>Trang chủ</a>
                        <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Cửa hàng</a>
                        <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Shop
                            Detail</a>
                        <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Giỏ hàng</a>
                        <a class="text-dark mb-2" href="checkout.html"><i class="fa fa-angle-right mr-2"></i>Giới
                            thiệu</a>
                        <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Liên hệ</a>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4">Tài khoản</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-dark mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Thông tin tài
                            khoản</a>
                        <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Đăng xuất</a>
                        <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Đăng nhập</a>
                        <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Đăng ký</a>
                        <a class="text-dark mb-2" href="checkout.html"><i class="fa fa-angle-right mr-2"></i>Theo dõi
                            đơn hàng</a>

                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4">LIÊN HỆ</h5>
                    <form method="post" action="{{ url('/guilienhe') }}">
                        <div class="form-group">
                            <input type="text" class="form-control border-0 py-4" name="ht"
                                placeholder="Họ và tên" required="required" />
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control border-0 py-4" name="em" placeholder="Email"
                                required="required" />
                        </div>
                        <div class="form-group">
                            <textarea class="form-control border-0 py-4" name="nd" placeholder="Nội dung liên hệ..." required="required"></textarea>
                        </div>
                        <div>
                            @csrf
                            <button class="btn btn-primary btn-block border-0 py-3" type="submit">Gửi liên hệ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Footer End -->
<!-- Back to Top -->
<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

<script>
    @if (Session::has('success'))
        Swal.fire('Thành công!', '{{ Session::get('success') }}', 'success');
    @elseif (Session::has('error'))
        Swal.fire('Lỗi!', '{{ Session::get('error') }}', 'error');
    @elseif (Session::has('qes'))
        Swal.fire({
            icon: "question",
            title: "Bạn chưa đăng nhập!!!",
            showConfirmButton: false,
            html: '<a href="{{ route('login') }}">Đăng nhập ngay?</a>',
        });
    @endif
</script>
<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('client') }}/lib/easing/easing.min.js"></script>
<script src="{{ asset('client') }}/lib/owlcarousel/owl.carousel.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<!-- Template Javascript -->
<script src="{{ asset('client') }}/js/main.js"></script>
<script>
    $(document).on('click', '.wishlist-toggle', function(e) {
        e.preventDefault();
        var $this = $(this);
        var productId = $this.data('product-id');
        var $icon = $this.find('i');
        var $text = $this.find('.wishlist-text');

        $.ajax({
            url: '/favorite/toggle/' + productId,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status === 'added') {
                    $icon.removeClass('text-primary').addClass('text-danger');
                    $text.text('Bỏ thích');
                    $this.attr('title', 'Bỏ thích');
                    Toastify({
                        text: "Đã thêm vào danh sách yêu thích!",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#4CAF50",
                    }).showToast();
                } else if (response.status === 'removed') {
                    $icon.removeClass('text-danger').addClass('text-primary');
                    $text.text('Thích');
                    $this.attr('title', 'Thích');
                    Toastify({
                        text: "Đã bỏ khỏi danh sách yêu thích!",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#f44336",
                    }).showToast();
                }
            },
            error: function() {
                Swal.fire('Lỗi!', 'Có lỗi xảy ra, vui lòng thử lại sau.', 'error');
            }
        });
    });
</script>
<script>
    function changeSort() {
        const sortValue = document.getElementById('sort-select').value;
        const categoryId = '{{ request('category_id') }}';
        window.location.href = '{{ url('/products') }}' + '?category_id=' + categoryId + '&sort_by=' + sortValue;
    }
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');

    function showSlide(index) {
        if (index >= slides.length) {
            currentSlide = 0;
        } else if (index < 0) {
            currentSlide = slides.length - 1;
        } else {
            currentSlide = index;
        }

        // Di chuyển các slide
        const offset = -currentSlide * 100;
        document.querySelector('.slides').style.transform = `translateX(${offset}%)`;

        // Cập nhật lớp "active" cho slide hiện tại
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === currentSlide);
        });
    }

    function moveSlide(n) {
        showSlide(currentSlide + n);
    }

    // Tự động chuyển slide mỗi 5 giây
    setInterval(() => {
        moveSlide(1);
    }, 5000);
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
    function changeSort() {
        const sortValue = document.getElementById('sort-select').value;
        const categoryId =
            '{{ request('
                                                                           category_id ') }}';
        window.location.href = '{{ url(' / products ') }}' + '?category_id=' + categoryId + '&sort_by=' + sortValue;
    }
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');

    function showSlide(index) {
        if (index >= slides.length) {
            currentSlide = 0;
        } else if (index < 0) {
            currentSlide = slides.length - 1;
        } else {
            currentSlide = index;
        }

        // Di chuyển các slide
        const offset = -currentSlide * 100;
        document.querySelector('.slides').style.transform = `translateX(${offset}%)`;

        // Cập nhật lớp "active" cho slide hiện tại
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === currentSlide);
        });
    }

    function moveSlide(n) {
        showSlide(currentSlide + n);
    }

    // Tự động chuyển slide mỗi 5 giây
    setInterval(() => {
        moveSlide(1);
    }, 5000);
</script>

<script>
    var app = angular.module('myApp', []);

    app.config(['$interpolateProvider', function($interpolateProvider) {
        $interpolateProvider.startSymbol('%%');
        $interpolateProvider.endSymbol('%%');
    }]);

    app.filter('customNumber', function($filter) {
        return function(input, fractionSize) {
            var formattedNumber = $filter('number')(input, fractionSize);
            return formattedNumber ? formattedNumber.replace(/,/g, '.') : '';
        };
    });

    app.controller('mainController', function($scope, $http) {

        $scope.cart = {!! json_encode(session('cart')) !!} || [];

        $scope.addToCart = function(product_id, quantity, stock) {
            // Tìm sản phẩm trong giỏ hàng
            let existingProduct = $scope.cart.find(item => item.id === product_id);

            // Nếu sản phẩm đã có trong giỏ hàng, kiểm tra số lượng cộng dồn với số lượng thêm mới
            let newQuantity = quantity;
            if (existingProduct) {
                newQuantity += existingProduct.soluong;
            }

            // Kiểm tra nếu tổng số lượng lớn hơn stock
            if (newQuantity > stock) {
                Swal.fire('Thông báo', 'Số lượng đã vượt quá tồn kho.', 'warning');
                return; // Dừng hàm nếu vượt quá tồn kho
            }

            // Gửi yêu cầu thêm sản phẩm vào giỏ hàng nếu kiểm tra hợp lệ
            $http.post('/api/cart', {
                product_id: product_id,
                quantity: quantity,
            }).then(function(res) {
                console.log("Kết quả trả về từ API:", res.data);

                if (res.data.status) {
                    // Thông báo thêm sản phẩm thành công
                    //Swal.fire('Thành công', res.data.message, 'success');
                    Toastify({
                        text: res.data.message,
                        duration: 2000,
                        destination: "https://github.com/apvarun/toastify-js",
                        newWindow: true,
                        close: true,
                        gravity: "top", // `top` or `bottom`
                        position: "right", // `left`, `center` or `right`
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        style: {
                            background: "linear-gradient(to right, #00b09b, #96c93d)",
                            color: "#ffffff", // Màu chữ trắng nổi bật
                            borderRadius: "8px", // Bo tròn các góc
                            boxShadow: "0 4px 8px rgba(0, 0, 0, 0.2)", // Hiệu ứng đổ bóng
                            padding: "16px", // Tăng padding cho thông báo
                        },
                        onClick: function() {}
                    }).showToast();
                }
                // Cập nhật giỏ hàng với dữ liệu trả về
                $scope.cart = res.data.data;
                console.log("Giỏ hàng sau khi cập nhật:", $scope.cart);


            }, function(error) {
                console.error('Lỗi:', error);
                Swal.fire('Lỗi!', 'Có lỗi xảy ra khi thêm vào giỏ hàng.', 'error');
            });
        };

        $scope.addToCart2 = function(product_id, quantity, stock) {
            // Tìm sản phẩm trong giỏ hàng
            let existingProduct = $scope.cart.find(item => item.id === product_id);

            // Nếu sản phẩm đã có trong giỏ hàng, kiểm tra số lượng cộng dồn với số lượng thêm mới
            let newQuantity = quantity;
            if (existingProduct) {
                newQuantity += existingProduct.soluong;
            }

            // Kiểm tra nếu tổng số lượng lớn hơn stock
            if (newQuantity > stock) {
                Swal.fire('Thông báo', 'Số lượng đã vượt quá tồn kho.', 'warning');
                return; // Dừng hàm nếu vượt quá tồn kho
            }

            // Gửi yêu cầu thêm sản phẩm vào giỏ hàng nếu kiểm tra hợp lệ
            $http.post('/api/cart', {
                product_id: product_id,
                quantity: quantity,
            }).then(function(res) {
                console.log("Kết quả trả về từ API:", res.data);

                if (res.data.status) {
                    window.location.href = '/cart';
                }
                // Cập nhật giỏ hàng với dữ liệu trả về
                $scope.cart = res.data.data;
                console.log("Giỏ hàng sau khi cập nhật:", $scope.cart);


            }, function(error) {
                console.error('Lỗi:', error);
                Swal.fire('Lỗi!', 'Có lỗi xảy ra khi thêm vào giỏ hàng.', 'error');
            });
        };


        $scope.clearCart = function() {
            Swal.fire({
                title: 'Xác nhận',
                text: "Bạn có chắc chắn muốn xóa tất cả sản phẩm trong giỏ hàng?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xóa'
            }).then((result) => {
                if (result.isConfirmed) {
                    $http.delete('/cart/clear').then(function(response) {
                        if (response.data.status) {
                            $scope.cart = []; // Xóa tất cả sản phẩm trong giỏ hàng

                            Swal.fire('Đã xóa!', 'Giỏ hàng đã được xóa thành công.',
                                'success');

                        }
                    }, function(error) {
                        console.error("Lỗi khi xóa giỏ hàng:", error);
                        Swal.fire('Lỗi!', 'Không thể xóa giỏ hàng. Vui lòng thử lại.',
                            'error');
                    });
                }
            });
        };

        $scope.totalCartMoney = function() {
            var total = 0;
            $scope.cart.forEach(sp => {
                total += (sp.soluong * ((sp.sale_price != null) ? sp.sale_price : sp.price));
            });
            return total;
        };

        $scope.removeFromCart = function(index) {
            $http.delete('/api/cart/' + index).then(function(res) {
                $scope.cart = res.data.data;
                Swal.fire('Thành công', 'Sản phẩm đã được xóa khỏi giỏ hàng!', 'success');
            }, function(error) {
                console.error('Lỗi:', error);
                Swal.fire('Lỗi!', 'Có lỗi xảy ra khi xóa sản phẩm khỏi giỏ hàng.', 'error');
            });
        };

        $scope.countTotalProducts = function() {
            var totalProducts = 0;
            $scope.cart.forEach(sp => {
                totalProducts += sp.soluong;
            });
            return totalProducts;
        };
    });

    var viewFunction = function($scope) {
        // Bổ sung các hàm liên quan đến giao diện nếu cần
    };
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>


@yield('viewFunction')


<script>
    app.controller('siteController', viewFunction)
</script>
</body>

</html>
