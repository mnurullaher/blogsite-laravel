<?php

namespace App\Services;

use App\DTO\PostDto;
use App\Models\Post;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\StorePostRequest;
use App\Repositories\PostRepository;

class PostService
{

  public function __construct(protected PostRepository $postRepository){}

  public function store(StorePostRequest $request) {

    $post = new PostDto(
      $request->validated('title'),
      $request->validated('body'),
      auth()->id()
    );

    $this->postRepository->store($post);
  }

  public function comment(Post $post, CommentRequest $request) {
    $post->comment([
      'title' => 'Some title',
      'body' => $request->validated('comment')
    ], auth()->user());
  }

  public function getLatestPosts($user) {
    return $this->postRepository->getLatestPosts($user);
  }

  public function getById($id) {
    return $this->postRepository->getById($id);
  }

  public function like($id) {
    $this->postRepository->like($id);
  }

  public function unlike($id) {
    $this->postRepository->unlike($id);
  }
}