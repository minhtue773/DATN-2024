@extends('clients.layout.app')
<!-- BREADCRUMBS SETCTION START -->
@section('title')
Home || 404
@endsection
@section('content')
<div id="page-content" class="page-wrapper">

    <!-- ERROR SECTION START -->
    <div class="error-section mb-80">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="error-404 box-shadow p-4"> <!-- Added p-4 class for Bootstrap padding -->
                        <img src="img/others/error.jpg" alt="" class="img-fluid">
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