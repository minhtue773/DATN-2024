
<div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12">
            <div class="card" style="border-radius: .5rem;">
                <div class="row g-0">
                    <div class="col-md-4 gradient-custom text-center text-white"
                        style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                            alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
                        <h5>{{ $user->name }}</h5>
                        <p>{{ $user->role == 1 ? 'Admin' : "khách hàng" }}</p>
                    </div>
                    <div class="col-md-8 bg-dark text-white" style="border-top-right-radius: .5rem; border-bottom-right-radius: .5rem;">
                        <div class="card-body p-4">
                            <h6>Thông tin cá nhân</h6>
                            <hr class="mt-0 mb-4">
                            <div class="row d-flex pt-1">
                                <div class="col-12 mb-3">
                                    <h6><p><i class="bi bi-envelope me-2"></i>Email: {{ $user->email }}</p></h6>
                                </div>
                                <div class="col-12 mb-3">
                                    <h6><p><i class="bi bi-telephone me-2"></i>Số điện thoại: {{ $user->phone_number }}</p></h6>
                                </div>
                            </div>
                            <hr class="mt-0 mb-4">
                            <div class="row pt-1">
                                <div class="col-6">
                                    <div class="card border-top-warning">
                                        <div class="card-body">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="bi bi-cart-check fs-1 font-weight-bold"></i>
                                                <h4>200</h4>
                                                <p>Đơn hàng dã mua</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card border-top-warning">
                                        <div class="card-body">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="bi bi-chat-dots fs-1 font-weight-bold"></i>
                                                <h4>200</h4>
                                                <p>Đánh giá & bình luận</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="d-flex justify-content-center">
                                <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                                <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                                <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

