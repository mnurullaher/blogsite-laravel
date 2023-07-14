<?php

namespace App\Repositories;

use App\DTO\UserDto;
use App\Models\User;

class UserRepository
{
  public function store(UserDto $user) {

    return User::create([
      'name' => $user->name,
      'email' => $user->email,
      'password' => $user->password
    ]);

  }
}