<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    // // Show replies for post
    // public function index(Post $post) {
    //     return view('replies.index', [
    //         'posts' => Reply::latest()->paginate(6)
    //     ]);
    // }

    // // Show single post
    // public function show(Post $post) {
    //     return view('posts.show', [
    //         'post' => $post
    //     ]);
    // }

    // // Show Create Form
    // public function create() {
    //     return view('posts.create');
    // }

    // Store Post Data
    public function store(Request $request, $post) {
        $formFields = $request->validate([
            'reply_body' => 'required'
        ]);

        $formFields['user_id'] = auth()->id();
        $formFields['post_id'] = $post;

        Reply::create($formFields);

        return redirect('/')->with('message', 'Post created successfully!');
    }

    // // Show Edit Form
    // public function edit(Post $post) {
    //     return view('posts.edit', ['post' => $post]);
    // }

    // // Update Post Data
    // public function update(Request $request, Post $post) {
    //     // Make sure logged in user is owner
    //     if($post->user_id != auth()->id()) {
    //         abort(403, 'Unauthorized Action');
    //     }
        
    //     $formFields = $request->validate([
    //         'title' => 'required',
    //         'tags' => 'required',
    //         'body' => 'required'
    //     ]);

    //     $post->update($formFields);

    //     return back()->with('message', 'Post updated successfully!');
    // }

    // Delete Reply
    public function destroy(Post $post, Reply $reply) {
        // Make sure logged in user is owner
        if($reply->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        // echo("<script>console.log('PHP: " . $reply . "');</script>");
        
        $reply->delete();
        return redirect('/')->with('message', 'Reply deleted successfully');
    }

    // // Dahsboard
    // public function dashboard(){
    //     return view('dashboard', ['posts' => request()->user()->posts()->get()]);
    // }
}
