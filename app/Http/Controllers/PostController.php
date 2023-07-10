<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $formFields['user_id'] = auth()->id();

        Post::create($formFields);
        return redirect('/');
    }
}
