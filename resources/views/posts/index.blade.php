@extends('layouts.app')

@section('content')
    <h1>Blog Posts</h1>
    @foreach($posts as $post)
        <div class="card mb-3">
            @if($post->featured_image)
                <img src="{{ asset('storage/'.$post->featured_image) }}" class="card-img-top" style="max-height: 300px; object-fit: cover;">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->short_description }}</p>
                <p class="text-muted">By {{ $post->author_name }} on {{ $post->created_at->format('M d, Y') }}</p>
                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Read More</a>
                @auth
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-secondary">Edit</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                @endauth
            </div>
        </div>
    @endforeach
@endsection