@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="display-4 fw-bold">Blog Posts</h1>
        @auth
        <a href="{{ route('posts.create') }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg me-1" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
            </svg>
            New Post
        </a>
        @endauth
    </div>

    <div class="row">
        @foreach($posts as $post)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm border-0 rounded-lg overflow-hidden">
                @if($post->featured_image)
                    <img src="{{ asset('storage/'.$post->featured_image) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-light text-dark">{{ $post->created_at->diffForHumans() }}</span>
                        @auth
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                    <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                </svg>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="{{ route('posts.edit', $post->id) }}">Edit</a></li>
                                <li>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        @endauth
                    </div>
                    
                    <h5 class="card-title fw-bold">{{ $post->title }}</h5>
                    <p class="card-text text-muted">{{ $post->short_description }}</p>
                    
                    <div class="d-flex align-items-center mt-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill me-1" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                        </svg>
                        <small class="text-muted">{{ $post->author_name }}</small>
                    </div>
                </div>
                <div class="card-footer bg-white border-0">
                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-primary w-100">Read More</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($posts->hasPages())
    <div class="d-flex justify-content-center mt-5">
        {{ $posts->links() }}
    </div>
    @endif
</div>
@endsection