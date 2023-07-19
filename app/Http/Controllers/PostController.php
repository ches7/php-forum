<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Show all posts
    public function index() {
        return view('index', [
            'posts' => Post::latest()->paginate(6)
        ]);
    }
}
