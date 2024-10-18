<footer class="footer-area">
    <div class="footer-top">
        <div class="container-fluid p-0">
            <div class="footer-top-inner theme-bg">
                <div class="row">
                    <div class="col-lg-4 col-md-5 col-sm-4">
                        <div class="single-footer footer-about">
                            <div style="text-align: center;" class="footer-logo">
                                <img style="height: 44px;" src="{{ asset('img/logo/logo.png') }}" alt="Logo Hobby Zone">
                            </div>
                            <div class="footer-brief">
                                <p>Hobby Zone là nơi cung cấp các mô hình chất lượng cao phục vụ đam mê của bạn.
                                    Chúng tôi cam kết mang đến cho khách hàng những sản phẩm mô hình chi tiết và
                                    tinh xảo từ các thương hiệu nổi tiếng.</p>
                                <p>Dù bạn là người mới bắt đầu hay đã là một nhà sưu tập lâu năm, Hobby Zone đều
                                    có những sản phẩm phù hợp để giúp bạn thực hiện sở thích của mình một cách
                                    hoàn hảo.</p>
                            </div>
                            <ul class="footer-social">
                                <li>
                                    <a class="facebook" href="#" title="Facebook"><i
                                            class="zmdi zmdi-facebook"></i></a>
                                </li>
                                <li>
                                    <a class="google-plus" href="#" title="Google Plus"><i
                                            class="zmdi zmdi-google-plus"></i></a>
                                </li>
                                <li>
                                    <a class="twitter" href="#" title="Twitter"><i
                                            class="zmdi zmdi-twitter"></i></a>
                                </li>
                                <li>
                                    <a class="rss" href="#" title="RSS"><i class="zmdi zmdi-rss"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 hidden-md hidden-sm">
                        <div class="single-footer">
                            <h4 class="footer-title border-left">Sản phẩm</h4>
                            <ul class="footer-menu">
                                <li>
                                    <a href="#"><i class="zmdi zmdi-circle"></i><span>Sản phẩm mới</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="zmdi zmdi-circle"></i><span>Sản phẩm giảm giá</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="zmdi zmdi-circle"></i><span>Sản phẩm bán chạy</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="zmdi zmdi-circle"></i><span>Sản phẩm phổ biến</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="zmdi zmdi-circle"></i><span>Nhà sản xuất</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="zmdi zmdi-circle"></i><span>Nhà cung cấp</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="zmdi zmdi-circle"></i><span>Sản phẩm đặc biệt</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4">
                        <div class="single-footer">
                            <h4 class="footer-title border-left">Tài khoản của tôi</h4>
                            <ul class="footer-menu">
                                <li>
                                    <a href="#"><i class="zmdi zmdi-circle"></i><span>Tài khoản của tôi</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="zmdi zmdi-circle"></i><span>Danh sách yêu
                                            thích</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="zmdi zmdi-circle"></i><span>Giỏ hàng của tôi</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="zmdi zmdi-circle"></i><span>Đăng nhập</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="zmdi zmdi-circle"></i><span>Đăng ký</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="zmdi zmdi-circle"></i><span>Thanh toán</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="zmdi zmdi-circle"></i><span>Đơn hàng hoàn tất</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="single-footer">
                            <h4 class="footer-title border-left">Liên hệ với chúng tôi</h4>
                            <div class="footer-message">
                                <form method="post" action="{{ url('/guilienhe') }}">
                                    <input type="text" name="ht" placeholder="Tên của bạn...">
                                    <input type="text" name="em" placeholder="Email của bạn...">
                                    <textarea class="height-80" name="nd" placeholder="Nội dung liên hệ..."></textarea>
                                    @csrf
                                    <button class="submit-btn-1 mt-20 btn-hover-1" type="submit">Gửi liên hệ</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Các thư viện JS -->
<script src="{{ asset('js/vendor/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('lib/js/jquery.nivo.slider.js') }}"></script>
<script src="{{ asset('js/plugins.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
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

        

        $scope.addToCart = function(product_id, quantity) {
            $http.post('/api/cart', {
                product_id: product_id,
                quantity: quantity,
            }).then(function(res) {
                $scope.cart = res.data.data;
            });
        };

        $scope.totalCartMoney = function() {
            var total = 0;
            $scope.cart.forEach(sp => {
                total += (sp.soluong * ((sp.sale_price != null) ? sp.sale_price : sp.price));
            });
            return total;
        }

        $scope.removeFromCart = function(index) {
            $http.delete('/api/cart/' + index).then(function(res) {
                $scope.cart = res.data.data;
            });
        }

        $scope.countTotalProducts = function() {
            var totalProducts = 0;
            $scope.cart.forEach(sp => {
                totalProducts += sp.soluong;
            });
            return totalProducts;
        };
    });

    var viewFunction = function($scope) {
        // Any additional view-related functions
    };
</script>

@yield('viewFunction')


<script>
    app.controller('siteController', viewFunction)
</script>
</body>

</html>
