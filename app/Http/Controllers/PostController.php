<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Reply;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    // Show all posts
    public function index() {
        // $posts = Post::with('user')->get();        
        // $posts = Post::latest()->with('user')->get();        
        // echo("<script>console.log('PHP: " . $posts . "');</script>");
        
        return view('posts.index', [
            'posts' => Post::latest()->filter(request(['tag', 'search']))->with('user')->paginate(6)
        ]);
    }

    // Show single post
    public function show(Post $post) {
        $replies = Reply::query()->where('post_id', $post->id)->with('user')->get();
        // echo("<script>console.log('PHP: " . $post . "');</script>");
        Session::put('post_url', request()->fullUrl());
        // $post = Post::with('user')->get();
        Post::with('user')->get();
        // echo Session::get('post_url');
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

        if(session('post_url')){
            return redirect(session('post_url'));
        }
        return redirect('/');
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
        
        $messagesSent = DB::table('messages')->where([
            ['sender_id', auth()->id()]
        ])->get();
        $messagesRecieved = DB::table('messages')->where([
            ['recipient_id', auth()->id()]
        ])->get();

        $userIds = array();

        foreach ($messagesSent as $message){
           $userIds[] = $message->recipient_id;
        };
        foreach ($messagesRecieved as $message){
            $userIds[] = $message->sender_id;
        };

        $userIds = array_unique($userIds);

        $users = DB::table('users')->select('id', 'name')->where([
            ['id', $userIds],
        ])->get();
        
        // echo dd($users);

        return view('dashboard', 
        ['posts' => request()->user()->posts()->get()],
        ['users' => $users]
        );
    }
}
