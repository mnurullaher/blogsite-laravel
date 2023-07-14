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
            'posts' =>  $this->service->getLatestPosts(request(['user']))
        ]);
    }

    public function show(int $post) {
        return view('posts.show', [
            'post' => $this->service->getById($post)
        ]);
    }

    public function create() {
        return view('posts.create');
    }

    public function store(StorePostRequest $request) {
        $this->service->store($request);
        return redirect('/');
    }

    public function like(int $post) {
        $this->service->like($post);
        return back();
    }

    public function unlike(int $post) {
        $this->service->unlike($post);
        // $post->unlike(auth()->id());
        return back();
    }

    public function comment(Post $post, CommentRequest $request ) {
        $this->service->comment($post, $request);
        return back();
    }
}
