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
        return back();
    }

    public function comment(int $postId, CommentRequest $request ) {
        $this->service->comment($postId, $request);
        return back();
    }

    public function edit(int $post) {
        $currentPost = $this->service->getById($post);  
        if($currentPost->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        return view('posts.edit', [
            'post' => $currentPost
        ]);
    }

    public function update(StorePostRequest $request, int $postId) {
        $this->service->update($request, $postId);
        return redirect('/');
    }
}
