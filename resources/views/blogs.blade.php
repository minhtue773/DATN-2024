@extends('layout_user.blogs')
@section('blogs')
@foreach($posts as $p)
    <div class="col-sm-6 col-xs-12">
        <div class="blog-item-2">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="blog-image">
                        <a href="{{ url('/blog', [$p->id]) }}"><img src="img/blog/4.jpg" alt=""></a>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="blog-desc">
                        <h5 class="blog-title-2"><a href="{{ url('/blog', [$p->id]) }}">{{ \Illuminate\Support\Str::limit($p->title,40) }}</a></h5>
                        <p class="blog-description">{{ \Illuminate\Support\Str::limit($p->description, 150) }}</p> <!-- Giới hạn 200 ký tự -->
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