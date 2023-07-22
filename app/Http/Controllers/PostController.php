<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\StorePostRequest;
use Illuminate\View\View;

class PostController extends Controller
{

    public function __construct(protected PostService $service){}

    public function index() {
        return view('posts.index', [
            'posts' =>  $this->service->getLatestPosts(request(['user']))
        ]);
    }

    public function show(int $id) {
        return view('posts.show', [
            'post' => $this->service->getById($id)
        ]);
    }

    public function create() {
        return view('posts.create');
    }

    public function store(StorePostRequest $request) {
        $this->service->store($request);
        return redirect('/');
    }

    public function like(int $id) {
        $this->service->like($id);
        return back();
    }

    public function unlike(int $id) {
        $this->service->unlike($id);
        return back();
    }

    public function comment(int $id, CommentRequest $request ) {
        $this->service->comment($id, $request);
        return back();
    }

    public function edit(int $id) {
        $currentPost = $this->service->getById($id);
        if($currentPost->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        return view('posts.edit', [
            'post' => $currentPost
        ]);
    }

    public function update(StorePostRequest $request, int $id) {
        $currentPost = $this->service->getById($id);
        if($currentPost->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $this->service->update($request, $id);

        return redirect('/');
    }

    public function delete(int $id) {
        $currentPost = $this->service->getById($id);
        if($currentPost->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $this->service->delete($id);
        
        return redirect('/');
    }
}
