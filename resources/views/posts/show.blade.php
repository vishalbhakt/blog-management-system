@extends('layouts.app')

@section('content')
    <div class="card">
        @if($post->featured_image)
            <img src="{{ asset('storage/'.$post->featured_image) }}" class="card-img-top">
        @endif
        <div class="card-body">
            <h1>{{ $post->title }}</h1>
            <p class="text-muted">By {{ $post->author_name }} on {{ $post->created_at->format('M d, Y') }}</p>
            <p>{{ $post->content }}</p>
            <a href="{{ route('posts.index') }}" class="btn btn-primary">Back to Posts</a>
        </div>
    </div>
@endsection