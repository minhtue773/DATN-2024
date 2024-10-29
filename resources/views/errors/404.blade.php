@extends('clients.layout.app')
<!-- BREADCRUMBS SETCTION START -->
@section('title')
Home || 404
@endsection
@section('content')
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">404</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="/">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">404</p>
        </div>
    </div>
</div>
<div id="page-content" class="page-wrapper">

    <!-- ERROR SECTION START -->
    <div class="error-section mb-80">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="error-404 box-shadow p-4"> <!-- Added p-4 class for Bootstrap padding -->
                        <img src="{{ asset('img/others/error.jpg') }}" alt="" class="img-fluid">
                        <div class="go-to-btn btn-hover-2 mt-3"> <!-- Add margin-top for spacing -->
                            <a href="/" class="btn btn-primary">Trở về trang chủ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ERROR SECTION END -->
</div>
<!-- End page content -->
@endsection