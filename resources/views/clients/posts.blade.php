@extends('clients.layout.app')
@section('title')
Bài viết
@endsection
@section('content')
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">@yield('title')</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">@yield('title')</p>
        </div>
    </div>
</div>
<!-- Page Header End -->
<!--================Blog Categorie Area =================-->
<section class="blog_categorie_area">
    <div class="container">
        <div class="row">
            @foreach ( $cate_features as $cate)
            <div class="col-lg-4">
                <div class="categories_post">
                    <img src="{{ asset('uploads/images/post_category/' . $cate->image) }}" alt="post">
                    <div class="categories_details">
                        <div class="categories_text">
                            <a href="{{ route('posts.index', ['post_cateId' => $cate->id]) }}">
                                <h5>{{ $cate->name }}</h5>
                            </a>
                            <div class="border_line"></div>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!--================Blog Categorie Area =================-->

<!--================Blog Area =================-->
<section class="blog_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog_left_sidebar">
                    @if($posts->isEmpty())
                    <div class="col-md-12">
                        <p style="font-size: 18px; font-weight: bold; color: #ff6600;">
                            Không có bài viết nào phù hợp với tìm kiếm của bạn.
                        </p>
                    </div>
                    @else
                    @foreach($posts as $post)
                    <article class="row blog_item">
                        <div class="col-md-3">
                            <div class="blog_info text-right">
                                <div class="post_tag">
                                    <a href="#">{{ $post->category->name }}</a> <!-- Thay bằng tên danh mục nếu cần -->
                                </div>
                                <ul class="blog_meta list list-unstyled">
                                    <li><a href="#">{{ $post->user->name }}<i class="lnr lnr-   user"></i></a></li>
                                    <li><a href="#">{{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('d M Y') }}<i class="lnr lnr-calendar-full"></i></a></li>
                                    <li><a href="#">{{ $post->views ?? '0' }} Views<i class="lnr lnr-eye"></i></a></li>
                                    <li><a href="#">{{ $post->comments_count ?? '0' }} Comments<i class="lnr lnr-bubble"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="blog_post">
                                <img src="{{ asset('uploads/images/post/' . $post->image) }}" alt="{{ $post->title }}">
                                <div class="blog_details">
                                    <a href="{{ route('posts.show', ['slug' => $post->slug]) }}">
                                        <h2>{{ $post->title }}</h2>
                                    </a>
                                    <p>{{ $post->description }}</p>
                                    <a href="{{ route('posts.show', ['slug' => $post->slug]) }}" class="white_bg_btn">Xem thêm</a>
                                </div>
                            </div>
                        </div>
                    </article>
                    @endforeach
                    @endif

                    <ul class="shop-pagination box-shadow text-center ptblr-10-30">
                        {{ $posts->links('vendor.pagination.custom-pagination') }}
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget search_widget">
                        <form action="/posts" method="GET">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Tìm kiếm bài viết" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Tìm kiếm bài viết'">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="lnr lnr-magnifier"></i></button>
                                </span>
                            </div>
                        </form>

                        <div class="br"></div>
                    </aside>
                    <!-- <aside class="single_sidebar_widget author_widget">
                        <img class="author_img rounded-circle" src="{{ asset('client') }}/img/blog/author.png" alt="">
                        <h4>Charlie Barber</h4>
                        <p>Senior blog writer</p>
                        <div class="social_icon">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-github"></i></a>
                            <a href="#"><i class="fa fa-behance"></i></a>
                        </div>
                        <p>Boot camps have its supporters andit sdetractors. Some people do not understand why you
                            should have to spend money on boot camp when you can get. Boot camps have itssuppor
                            ters andits detractors.</p>
                        <div class="br"></div>
                    </aside> -->
                    <aside class="single_sidebar_widget popular_post_widget">
                        <h3 class="widget_title">Bài viết nổi bật</h3>
                        @foreach ($post_features as $post)
                        <div class="media post_item">
                            <img src="{{ asset('uploads/images/post/' . $post->image) }}" alt="post" class="img-fluid w-25">
                            <div class="media-body">
                                <a href="blog-details.html">
                                    <h3>{{ $post->title }}</h3>
                                </a>
                                <p>02 Hours ago</p>
                            </div>
                        </div>
                        @endforeach
                        <div class="br"></div>
                    </aside>

                    <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title">Danh mục bài viết</h4>
                        <ul class="list cat-list list-unstyled">
                            <li>
                                <a href="/posts" class="d-flex justify-content-between">
                                    <p>Tất cả</p>
                                    <p>000</p>
                                </a>
                            </li>
                            @foreach ($post_cate_arr as $post_cate)
                            <li>
                                <a href="{{ route('posts.index', ['post_cateId' => $post_cate->id]) }}" class="d-flex justify-content-between">
                                    <p>{{ $post_cate->name}}</p>
                                    <p>{{ $post_cate->posts->count()}}</p>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        <div class="br"></div>
                    </aside>

                    <!-- <aside class="single-sidebar-widget tag_cloud_widget">
                            <h4 class="widget_title">Tag Clouds</h4>
                            <ul class="list">
                                <li><a href="#">Technology</a></li>
                                <li><a href="#">Fashion</a></li>
                                <li><a href="#">Architecture</a></li>
                                <li><a href="#">Fashion</a></li>
                                <li><a href="#">Food</a></li>
                                <li><a href="#">Technology</a></li>
                                <li><a href="#">Lifestyle</a></li>
                                <li><a href="#">Art</a></li>
                                <li><a href="#">Adventure</a></li>
                                <li><a href="#">Food</a></li>
                                <li><a href="#">Lifestyle</a></li>
                                <li><a href="#">Adventure</a></li>
                            </ul>
                        </aside> -->
                </div>
            </div>
        </div>
    </div>
</section>
<!--================Blog Area =================-->
@endsection