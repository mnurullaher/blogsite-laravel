<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{

    public function __construct(protected PostService $service){}

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

    public function create() {
        return view('posts.create');
    }

    public function store(StorePostRequest $request) {
        $this->service->store($request);
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

    public function comment(Post $post, CommentRequest $request ) {
        $this->service->comment($post, $request);
        return back();
    }
}
