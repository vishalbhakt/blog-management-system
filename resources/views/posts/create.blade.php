@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-header bg-white py-3 border-0">
                    <h1 class="h4 fw-bold mb-0">Create New Post</h1>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="title" class="form-label fw-bold">Title</label>
                            <input type="text" class="form-control form-control-lg" id="title" name="title" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="short_description" class="form-label fw-bold">Short Description</label>
                            <textarea class="form-control" id="short_description" name="short_description" rows="3" required></textarea>
                        </div>
                        
                        <div class="mb-4">
                            <label for="content" class="form-label fw-bold">Content</label>
                            <textarea class="form-control" id="content" name="content" rows="8" required></textarea>
                        </div>
                        
                        <div class="mb-4">
                            <label for="author_name" class="form-label fw-bold">Author Name</label>
                            <input type="text" class="form-control" id="author_name" name="author_name" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="featured_image" class="form-label fw-bold">Featured Image</label>
                            <input type="file" class="form-control" id="featured_image" name="featured_image">
                            <small class="text-muted">Recommended size: 1200x630 pixels</small>
                        </div>
                        
                        <div class="d-flex justify-content-between mt-5">
                            <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4">Publish Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection