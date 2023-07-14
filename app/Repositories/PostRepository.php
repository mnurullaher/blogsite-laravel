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

  public function getLatestPosts($user) {
    return Post::latest()->filter($user)->simplePaginate(2);
  }

  public function getById($id) {
    return Post::find($id);
  }

  public function like($id) {
    Post::find($id)->like();
  }

  public function unlike($id) {
    Post::find($id)->unlike(auth()->id());
  }

}