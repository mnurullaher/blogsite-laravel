<?php

namespace App\DTO;

class PostDto
{
  public function __construct(public string $title, public string $body, public int $user_id){}
}