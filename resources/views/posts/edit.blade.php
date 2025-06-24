@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-header bg-white py-3 border-0">
                    <h1 class="h4 fw-bold mb-0">Edit Post</h1>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="title" class="form-label fw-bold">Title</label>
                            <input type="text" class="form-control form-control-lg" id="title" name="title" value="{{ old('title', $post->title) }}" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="short_description" class="form-label fw-bold">Short Description</label>
                            <textarea class="form-control" id="short_description" name="short_description" rows="3" required>{{ old('short_description', $post->short_description) }}</textarea>
                        </div>
                        
                        <div class="mb-4">
                            <label for="content" class="form-label fw-bold">Content</label>
                            <textarea class="form-control" id="content" name="content" rows="8" required>{{ old('content', $post->content) }}</textarea>
                        </div>
                        
                        <div class="mb-4">
                            <label for="author_name" class="form-label fw-bold">Author Name</label>
                            <input type="text" class="form-control" id="author_name" name="author_name" value="{{ old('author_name', $post->author_name) }}" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="featured_image" class="form-label fw-bold">Featured Image</label>
                            <input type="file" class="form-control" id="featured_image" name="featured_image">
                            @if($post->featured_image)
                                <div class="mt-3">
                                    <p class="mb-2">Current Image:</p>
                                    <img src="{{ asset('storage/'.$post->featured_image) }}" width="150" class="img-thumbnail">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" id="remove_image" name="remove_image">
                                        <label class="form-check-label text-danger" for="remove_image">
                                            Remove current image
                                        </label>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <div class="d-flex justify-content-between mt-5">
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4">Update Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection