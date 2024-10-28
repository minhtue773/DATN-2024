 <!-- Footer Start -->
 <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
     <div class="row px-xl-5 pt-5">
         <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
             <a href="" class="text-decoration-none">
                 <img src="{{ $settingsArray['img_logo']['setting_value']}}" alt="Logo" class="img-fluid w-75">
             </a>
             <p class="mt-3">{{ $settingsArray['description_company']['setting_value'] ?? 'Chưa được cập nhật' }}</p>
             <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>{{ $settingsArray['address']['setting_value'] ?? 'Địa chỉ chưa được cập nhật' }}</p>
             <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>{{ $settingsArray['email']['setting_value'] ?? 'Email chưa được cập nhật' }} </p>
             <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>{{ $settingsArray['phone']['setting_value'] ?? '+012 345 67890' }}</p>
         </div>
         <div class="col-lg-8 col-md-12">
             <div class="row">
                 <div class="col-md-4 mb-5">
                     <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                     <div class="d-flex flex-column justify-content-start">
                         <a class="text-dark mb-2" href="index.html"><i
                                 class="fa fa-angle-right mr-2"></i>Home</a>
                         <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Our
                             Shop</a>
                         <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Shop
                             Detail</a>
                         <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Shopping
                             Cart</a>
                         <a class="text-dark mb-2" href="checkout.html"><i
                                 class="fa fa-angle-right mr-2"></i>Checkout</a>
                         <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact
                             Us</a>
                     </div>
                 </div>
                 <div class="col-md-4 mb-5">
                     <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                     <div class="d-flex flex-column justify-content-start">
                         <a class="text-dark mb-2" href="index.html"><i
                                 class="fa fa-angle-right mr-2"></i>Home</a>
                         <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Our
                             Shop</a>
                         <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Shop
                             Detail</a>
                         <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Shopping
                             Cart</a>
                         <a class="text-dark mb-2" href="checkout.html"><i
                                 class="fa fa-angle-right mr-2"></i>Checkout</a>
                         <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact
                             Us</a>
                     </div>
                 </div>
                 <div class="col-md-4 mb-5">
                     <h5 class="font-weight-bold text-dark mb-4">LIÊN HỆ</h5>
                     <form method="post" action="{{ url('/guilienhe') }}">
                         <div class="form-group">
                             <input type="text" class="form-control border-0 py-4" name="ht" placeholder="Họ và tên"
                                 required="required" />
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
    @if(Session::has('success'))
        Swal.fire('Thành công!', '{{ Session::get('success') }}', 'success');
    @elseif(Session::has('error'))
        Swal.fire('Lỗi!', '{{ Session::get('error') }}', 'error');
    @endif
</script>
 <!-- JavaScript Libraries -->
 <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
 <script src="{{ asset('client') }}/lib/easing/easing.min.js"></script>
 <script src="{{ asset('client') }}/lib/owlcarousel/owl.carousel.min.js"></script>
 <!-- Template Javascript -->
 <script src="{{ asset('client') }}/js/main.js"></script>
 <script>
     $(document).on('click', '.wishlist-toggle', function(e) {
         e.preventDefault();
         var productId = $(this).data('product-id');
         var $icon = $(this).find('i');

         $.ajax({
             url: '/favorite/toggle/' + productId,
             method: 'POST', // Phải là 'POST'
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token để bảo mật
             },
             success: function(response) {
                 if (response.status === 'added') {
                     $icon.addClass('favorited');
                 } else if (response.status === 'removed') {
                     $icon.removeClass('favorited');
                 }
             },
             error: function() {
                 alert('Có lỗi xảy ra, vui lòng thử lại sau.');
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
 <script>
     function changeSort() {
         const sortValue = document.getElementById('sort-select').value;
         const categoryId = '{{ request('
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
 </body>

 </html>