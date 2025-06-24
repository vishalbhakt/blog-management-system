<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $posts = Post::latest()->paginate(10); // Added pagination
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255|unique:posts',
            'short_description' => 'required|max:500',
            'content' => 'required',
            'author_name' => 'required|max:100',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $post = new Post($validated);
        $post->slug = Str::slug($request->title);
        $post->user_id = auth()->id();

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('posts', 'public');
            $post->featured_image = $path;
        }

        $post->save();

        return redirect()->route('posts.show', $post->slug)
                         ->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post); // Added authorization
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post); // Added authorization

        $validated = $request->validate([
            'title' => 'required|max:255|unique:posts,title,'.$post->id,
            'short_description' => 'required|max:500',
            'content' => 'required',
            'author_name' => 'required|max:100',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'remove_image' => 'nullable|boolean'
        ]);

        // Handle image removal
        if ($request->remove_image && $post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
            $post->featured_image = null;
        }

        // Handle new image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            
            $path = $request->file('featured_image')->store('posts', 'public');
            $post->featured_image = $path;
        }

        $post->update($validated);

        return redirect()->route('posts.show', $post->slug)
                         ->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post); // Added authorization

        // Delete associated image
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();

        return redirect()->route('posts.index')
                         ->with('success', 'Post deleted successfully!');
    }
}