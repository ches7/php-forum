<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reply;
use App\Models\Post;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user){
        $posts = Post::query()->where('user_id', $user->id)->get();
        $replies = Reply::query()->where('user_id', $user->id)->get();
        echo("<script>console.log('PHP: " . $user . "');</script>");
        return view('users.show', [
            'user' => $user,
            'posts' => $posts,
            'replies' => $replies,
        ]);
    }
}