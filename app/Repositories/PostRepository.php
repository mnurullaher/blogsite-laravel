<?php

namespace App\Repositories;

use App\DTO\PostDto;
use App\Models\Post;

class PostRepository
{

  public function store(PostDto $post) {
    Post::create([
      'title' => $post->title,
      'body' => $post ->body,
      'user_id' => $post->user_id
    ]);
  }

  public function getLatestPosts(array $filters) {
    return Post::latest()->filter($filters)->simplePaginate(6);
  }

  public function getById(int $id) {
    return Post::find($id);
  }

  public function like(int $id) {
    Post::find($id)->like();
  }

  public function unlike(int $id) {
    Post::find($id)->unlike(auth()->id());
  }

  public function comment(int $id, $commentFields) {
    Post::find($id)->comment($commentFields, auth()->user());
  }

  public function update(int $id, $updatedFields ) {
    Post::find($id)->update($updatedFields);
  }

  public function delete(int $id) {
    Post::find($id)->delete();
  }

}