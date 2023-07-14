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

  public function update(StorePostRequest $request, int $postId) {

    $updatedFields = [
      'title' => $request->validated('title'),
      'body' => $request->validated('body'),
    ];

    $this->postRepository->update($postId, $updatedFields );
  }

  public function comment(int $postId, CommentRequest $request) {
    $commentFields = [
        'title' => 'Will be handled later',
        'body' => $request->validated('comment')
      ];
    $this->postRepository->comment($postId, $commentFields);
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