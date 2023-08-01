<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reply;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Show all posts
    public function index() {
        return view('posts.index', [
            'posts' => Post::latest()->paginate(6)
        ]);
    }

    // Show single post
    public function show(Post $post) {
        $replies = Reply::query()->where('post_id', $post->id)->get();
        // echo("<script>console.log('PHP: " . $post . "');</script>");
        return view('posts.show', [
            'post' => $post,
            'replies' => $replies
        ]);
    }

    // Show Create Form
    public function create() {
        return view('posts.create');
    }

    // Store Post Data
    public function store(Request $request) {
        $formFields = $request->validate([
            'title' => 'required',
            'tags' => 'required',
            'body' => 'required'
        ]);

        $formFields['user_id'] = auth()->id();

        Post::create($formFields);

        return redirect('/')->with('message', 'Post created successfully!');
    }

    // Show Edit Form
    public function edit(Post $post) {
        return view('posts.edit', ['post' => $post]);
    }

    // Update Post Data
    public function update(Request $request, Post $post) {
        // Make sure logged in user is owner
        if($post->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $formFields = $request->validate([
            'title' => 'required',
            'tags' => 'required',
            'body' => 'required'
        ]);

        $post->update($formFields);

        return back()->with('message', 'Post updated successfully!');
    }

    // Delete Post
    public function destroy(Post $post) {
        // Make sure logged in user is owner
        if($post->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $post->delete();
        return redirect('/')->with('message', 'Post deleted successfully');
    }

    // Dahsboard
    public function dashboard(){
        return view('dashboard', ['posts' => request()->user()->posts()->get()]);
    }
}
