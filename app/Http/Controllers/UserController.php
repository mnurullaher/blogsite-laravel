<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\UserService;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    public function __construct(protected UserService $service){}

    public function create() {
        return view('users.register');
    }

    public function store(StoreUserRequest $request) {

        $this->service->store($request);
        return redirect('/');
    }

    public function login() {
        return view('users.login');
    }

    public function authenticate(LoginRequest $request) {
        $this->service->authenticate($request);

        return back()->withErrors(['email'=>'Invalid Credentials'])
        ->onlyInput('email');
    }

    public function logout() {
        auth()->logout();
        return redirect('/');
    }
}
