<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    // Store Reply Data
    public function store(Request $request, $post) {
        $formFields = $request->validate([
            'reply_body' => 'required'
        ]);

        $formFields['user_id'] = auth()->id();
        $formFields['post_id'] = $post;

        Reply::create($formFields);

        if(session('post_url')){
            return redirect(session('post_url'));
        }
        return redirect('/')->with('message', 'Post created successfully!');
    }

    // Show Edit Form
    public function edit(Post $post, Reply $reply) {
        return view('replies.edit', [
            'post' => $post,
            'reply' => $reply
        ]);
    }

    // Update Reply Data
    public function update(Request $request, Post $post, Reply $reply) {
        // Make sure logged in user is owner
        if($reply->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $formFields = $request->validate([
            'reply_body' => 'required'
        ]);

        $reply->update($formFields);

        if(session('post_url')){
            return redirect(session('post_url'));
        }
        return redirect('/');
    }

    // Delete Reply
    public function destroy(Post $post, Reply $reply) {
        // Make sure logged in user is owner
        if($reply->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        // echo("<script>console.log('PHP: " . $reply . "');</script>");
        
        $reply->delete();
        if(session('post_url')){
            return redirect(session('post_url'));
        }
        return redirect('/')->with('message', 'Reply deleted successfully');
    }
}
