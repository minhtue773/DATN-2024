@extends('clients.layout.app')
@section('title')
Bài viết chi tiết
@endsection
@section('content')
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">@yield('title')</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href=""> Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">@yield('title')</p>
        </div>
    </div>
</div>
<!-- Page Header End -->
<!--================Blog Area =================-->
<section class="blog_area single-post-area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 posts-list">
                <div class="single-post row">
                    <div class="col-lg-12">
                        <div class="feature-img">
                            <img class="img-fluid" src="/{{ $post->image_big }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-3  col-md-3">
                        <div class="blog_info text-right">
                            <div class="post_tag">
                                <a href="#">{{ $post->category->name }}</a> <!-- Thay bằng tên danh mục nếu cần -->
                            </div>
                            <ul class="blog_meta list">
                                <li><a href="#">{{ $post->user->name }}<i class="lnr lnr-user"></i></a></li> <!-- Giả định bạn có mối quan hệ với User -->
                                <li><a href="#">{{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('d M Y') }}<i class="lnr lnr-calendar-full"></i></a></li>
                                <li><a href="#">{{ $post->views ?? '0' }} Views<i class="lnr lnr-eye"></i></a></li> <!-- Giả định bạn có trường views -->
                                <li><a href="#">{{ $post->comments_count ?? '0' }} Comments<i class="lnr lnr-bubble"></i></a></li> <!-- Giả định bạn có trường comments_count -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 blog_details">
                        <h2>{{ $post->title }}</h2>
                        <p class="excert">
                            {{ $post->description }}
                        </p>
                    </div>
                    <div class="col-lg-12">
                        <div class="quotes">
                            {{ $post->content }}
                        </div>
                        <!-- <div class="row">
                            <div class="col-6">
                                <img class="img-fluid" src="{{ asset('client') }}/img/blog/post-img1.jpg" alt="">
                            </div>
                            <div class="col-6">
                                <img class="img-fluid" src="{{ asset('client') }}/img/blog/post-img2.jpg" alt="">
                            </div>
                            <div class="col-lg-12 mt-25">
                                <p>
                                    MCSE boot camps have its supporters and its detractors. Some people do not
                                    understand why you should have to spend money on boot camp when you can get the
                                    MCSE study materials yourself at a fraction of the camp price. However, who has
                                    the willpower.
                                </p>
                                <p>
                                    MCSE boot camps have its supporters and its detractors. Some people do not
                                    understand why you should have to spend money on boot camp when you can get the
                                    MCSE study materials yourself at a fraction of the camp price. However, who has
                                    the willpower.
                                </p>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="navigation-area">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                            <div class="thumb">
                                <a href="#"><img class="img-fluid" src="{{ asset('client') }}/img/blog/prev.jpg" alt=""></a>
                            </div>
                            <div class="arrow">
                                <a href="#"><span class="lnr text-white lnr-arrow-left"></span></a>
                            </div>
                            <div class="detials">
                                <p>Prev Post</p>
                                <a href="#">
                                    <h4>Space The Final Frontier</h4>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                            <div class="detials">
                                <p>Next Post</p>
                                <a href="#">
                                    <h4>Telescopes 101</h4>
                                </a>
                            </div>
                            <div class="arrow">
                                <a href="#"><span class="lnr text-white lnr-arrow-right"></span></a>
                            </div>
                            <div class="thumb">
                                <a href="#"><img class="img-fluid" src="{{ asset('client') }}/img/blog/next.jpg" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="comments-area">
                    <h4>05 Comments</h4>
                    <div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="{{ asset('client') }}/img/blog/c1.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">Emilly Blunt</a></h5>
                                    <p class="date">December 4, 2018 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                <a href="" class="btn-reply text-uppercase">reply</a>
                            </div>
                        </div>
                    </div>
                    <div class="comment-list left-padding">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="{{ asset('client') }}/img/blog/c2.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">Elsie Cunningham</a></h5>
                                    <p class="date">December 4, 2018 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                <a href="" class="btn-reply text-uppercase">reply</a>
                            </div>
                        </div>
                    </div>
                    <div class="comment-list left-padding">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="{{ asset('client') }}/img/blog/c3.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">Annie Stephens</a></h5>
                                    <p class="date">December 4, 2018 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                <a href="" class="btn-reply text-uppercase">reply</a>
                            </div>
                        </div>
                    </div>
                    <div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="{{ asset('client') }}/img/blog/c4.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">Maria Luna</a></h5>
                                    <p class="date">December 4, 2018 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                <a href="" class="btn-reply text-uppercase">reply</a>
                            </div>
                        </div>
                    </div>
                    <div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="{{ asset('client') }}/img/blog/c5.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">Ina Hayes</a></h5>
                                    <p class="date">December 4, 2018 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                <a href="" class="btn-reply text-uppercase">reply</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="comment-form">
                    <h4>Leave a Reply</h4>
                    <form>
                        <div class="form-group form-inline">
                            <div class="form-group col-lg-6 col-md-6 name">
                                <input type="text" class="form-control" id="name" placeholder="Enter Name" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Enter Name'">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 email">
                                <input type="email" class="form-control" id="email" placeholder="Enter email address"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="subject" placeholder="Subject" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Subject'">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control mb-10" rows="5" name="message" placeholder="Messege"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
                        </div>
                        <a href="#" class="primary-btn submit_btn">Post Comment</a>
                    </form>
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
                            <img src="/{{ $post->image }}" alt="post" class="img-fluid w-25">
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
                    <!-- <aside class="single_sidebar_widget ads_widget">
                        <a href="#"><img class="img-fluid" src="{{ asset('client') }}/img/blog/add.jpg" alt=""></a>
                        <div class="br"></div>
                    </aside> -->
                    <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title">Danh mục bài viết</h4>
                        <ul class="list cat-list">
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
                    <aside class="single-sidebar-widget newsletter_widget">
                        <h4 class="widget_title">Newsletter</h4>
                        <p>
                            Here, I focus on a range of items and features that we use in life without
                            giving them a second thought.
                        </p>
                        <div class="form-group d-flex flex-row">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter email"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email'">
                            </div>
                            <a href="#" class="bbtns">Subcribe</a>
                        </div>
                        <p class="text-bottom">You can unsubscribe at any time</p>
                        <div class="br"></div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================Blog Area =================-->
@endsection