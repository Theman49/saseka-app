<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\ContactUs;

class PageController extends Controller
{
    public function home(){
        $posts = Post::all()->sortByDesc('id');
        return view('home', [
            'title' => "Home",
            'posts' => $posts
        ]);
    }
    public function musik(){
        $posts = Post::where('kategori', 'musik')->get();
        return view('musik', [
            'title' => "Musik",
            'posts' => $posts
        ]);
    }
    public function rupa(){
        $posts = Post::where('kategori', 'rupa')->get();
        return view('rupa', [
            'title' => "Rupa",
            'posts' => $posts
        ]);
    }
    public function sastra(){
        $posts = Post::where('kategori', 'sastra')->get();
        return view('sastra', [
            'title' => "Sastra",
            'posts' => $posts 
        ]);
    }
    public function post(Post $post){
        return view('post', [
            'title' => "Post",
            'post' => $post
        ]);
    }
    public function contactUs(Request $request){
        $rules = [
            'name' => 'required',
            'email' => 'email|required',
            'message' => 'required'
        ];

        $validatedData = $request->validate($rules);

        ContactUs::create($validatedData);
        return redirect($request->currUrl)->with('success', 'Pesan Kamu Berhasil Dikirim :)');
    }
}
