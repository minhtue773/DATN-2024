@extends('layout_user.single_blog')

@section('blog_lien_quan')
@foreach($relatedPosts as $relatedPost)
    <div class="media mb-30" style="display: flex; align-items: center; justify-content: center;">
        <div class="media-left" style="margin-right: 10px;">
            <a href="{{ route('blogs.show', $relatedPost->id) }}">
                <img class="media-object" src="{{ asset($relatedPost->image) }}" alt="" style="width:120px; height:auto;">
            </a>
        </div>
        <div class="media-body" style="text-align: center;">
            <h6 class="media-heading">
                <a href="{{ route('blogs.show', $relatedPost->id) }}">{{ $relatedPost->title }}</a>
            </h6>
            <!-- Hiển thị ngày tháng bằng tiếng Việt -->
            <span class="met-date">{{ \Carbon\Carbon::parse($relatedPost->created_at)->translatedFormat('d M Y') }}</span>
        </div>
    </div>
@endforeach
@endsection