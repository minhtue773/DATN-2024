@extends('layout_user.blogs')
@section('blogs')
@foreach($posts as $p)
    <div class="col-sm-6 col-xs-12">
        <div class="blog-item-2">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="blog-image">
                        <!-- Sử dụng asset() để tạo đường dẫn ảnh đúng từ thư mục public -->
                        <a href="{{ url('/blog', [$p->id]) }}">
                            <img src="{{ asset($p->image) }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="blog-desc">
                        <h5 class="blog-title-2">
                            <a href="{{ url('/blog', [$p->id]) }}">{{ \Illuminate\Support\Str::limit($p->title, 40) }}</a>
                        </h5>
                        <p class="blog-date">
                            <!-- Hiển thị ngày tạo bài viết -->
                            {{ \Carbon\Carbon::parse($p->created_at)->translatedFormat('d M Y') }}
                        </p>
                        <p class="blog-description">{{ \Illuminate\Support\Str::limit($p->description, 150) }}</p> <!-- Giới hạn 150 ký tự -->
                        <div class="read-more">
                            <a href="{{ url('/blog', [$p->id]) }}">Đọc thêm</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection