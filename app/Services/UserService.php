<?php

namespace App\Services;

use App\DTO\UserDto;
use App\Http\Requests\LoginRequest;
use App\Repositories\UserRepository;
use App\Http\Requests\StoreUserRequest;

class UserService{

  public function __construct(protected UserRepository $userRepository){}

  public function store(StoreUserRequest $request) {

    $user = new UserDto(
      $request->validated('name'),
      $request->validated('email'),
      $request->validated('password'),
    );

    $user =  $this->userRepository->store($user);
    auth()->login($user);
  }

  public function authenticate(LoginRequest $request) {
    $credentials =  [
      'email' => $request->validated('email'),
      'password' => $request->validated('password')
    ];

    if(auth()->attempt($credentials)) {
      $request->session()->regenerate();

      return redirect('/');
  }
  }
}