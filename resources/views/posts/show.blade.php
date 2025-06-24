@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <article class="card shadow-sm border-0 rounded-lg overflow-hidden">
                @if($post->featured_image)
                    <img src="{{ asset('storage/'.$post->featured_image) }}" class="card-img-top img-fluid" style="max-height: 500px; object-fit: cover;">
                @endif
                <div class="card-body p-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-primary">{{ $post->created_at->diffForHumans() }}</span>
                        @auth
                        <div class="btn-group">
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                        @endauth
                    </div>
                    
                    <h1 class="display-4 fw-bold mb-3">{{ $post->title }}</h1>
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="mb-0 fw-bold">{{ $post->author_name }}</p>
                            <small class="text-muted">{{ $post->created_at->format('F j, Y') }}</small>
                        </div>
                    </div>
                    
                    <div class="post-content mb-5">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('posts.index') }}" class="btn btn-outline-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left me-1" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                            </svg>
                            Back to Posts
                        </a>
                        <div class="social-share">
                            <!-- Add social sharing buttons here -->
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>

<style>
    .post-content {
        line-height: 1.8;
        font-size: 1.1rem;
    }
    .post-content p {
        margin-bottom: 1.5rem;
    }
</style>
@endsection