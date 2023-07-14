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

}