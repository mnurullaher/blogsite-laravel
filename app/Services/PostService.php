<?php

namespace App\Services;

use App\DTO\PostDto;
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

  public function update(StorePostRequest $request, int $id) {

    $updatedFields = [
      'title' => $request->validated('title'),
      'body' => $request->validated('body'),
    ];

    $this->postRepository->update($id, $updatedFields );
  }

  public function comment(int $id, CommentRequest $request) {
    $commentFields = [
        'title' => 'Will be handled later',
        'body' => $request->validated('comment')
      ];
    $this->postRepository->comment($id, $commentFields);
  }

  public function getLatestPosts(array $filters) {
    return $this->postRepository->getLatestPosts($filters);
  }

  public function getById(int $id) {
    return $this->postRepository->getById($id);
  }

  public function like(int $id) {
    $this->postRepository->like($id);
  }

  public function unlike(int $id) {
    $this->postRepository->unlike($id);
  }

  public function delete(int $id) {
    $this->postRepository->delete($id);
  }
}