<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index() {
        return view('posts.index', [
            'posts' => Post::latest()->filter(request(['user']))->get()
        ]);
    }

    public function show(Post $post) {

        return view('posts.show', [
            'post' => $post
        ]);

    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $formFields['user_id'] = auth()->id();

        Post::create($formFields);
        return redirect('/');
    }

    public function like(Post $post) {
        $post->like();
        return back();
    }

    public function unlike(Post $post) {
        $post->unlike(auth()->id());
        return back();
    }

    public function comment(Post $post, Request $request ) {
        $commentBody = $request->validate([
            'comment' => 'required'
        ]);

        $post->comment([
            'title' => 'Some title',
            'body' => $commentBody['comment'],
        ], auth()->user());

        return back();
    }
}
