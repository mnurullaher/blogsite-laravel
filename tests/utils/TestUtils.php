<?php

namespace Tests\utils;

use App\Models\Post;
use App\Models\User;

class TestUtils
{

  public static function createUser() {
    return User::factory()->create();
  }

  public static function createPost(int $userId): Post {
    return Post::create([
        'title' => 'Test Title',
        'body' => 'Test Body',
        'user_id' => $userId
    ]);
}
}