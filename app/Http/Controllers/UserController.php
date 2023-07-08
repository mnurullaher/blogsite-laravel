<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function create(Request $request) {
        $formFields = $request->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('users', 'email')],
            'password' => 'required'
        ]);

        $user = User::create($formFields);
        auth()->login($user);

        return redirect('/');
    }

    public function login(Request $request) {
        $formFields = $request->validate([
            'loginemail' => 'required',
            'loginpassword' => 'required'
        ]);

        if(auth()->attempt(['email' => $formFields['loginemail'], 'password' => $formFields['loginpassword']])) {
            $request->session()->regenerate();
        }

        return redirect('/');
    }

    public function logout() {
        auth()->logout();
        return redirect('/');
    }
}
