<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class AdminController extends Controller
{
    public function dashboard(){
        if(isset($_SESSION['id'])){
            return view('admin/login', [
                'title' => 'Login'
            ]);
        }else{
            return view('admin/dashboard', [
                'title' => "Dashboard"
            ]);
        }
    }

    public function posts(){
        return view('admin/posts', [
            'title' => "Posts",
            'posts' => Post::all() 
        ]);
    }

    public function preview(Post $post){
        return view('admin/preview', [
            'title' => "Preview",
            'post' => $post
        ]);
    }

    public function edit(Post $post)
    {
        return view('admin/edit', [
            'title' => "Edit",
            'post' => $post
        ]);
    }

    public function insert(){
        return view('admin/insert', [
            'title' => "Tambah Post",
        ]);
    }
    
    public function createSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->judul);
        return response()->json(['slug' => $slug]);
    }

    public function createPost(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|max:255',
            'kategori' => 'required', 
            'deskripsi' => 'required'
        ]);

        $validatedData['path_file'] = "";

        Post::create($validatedData);

        return redirect('/admin/posts')->with('success', 'Karya baru berhasil ditambahkan!');
    }
     public function editPost(Request $request)
     {
        $validatedData = $request->validate([
            'judul' => 'required|max:255',
            'kategori' => 'required', 
            'deskripsi' => 'required'
        ]);

        $validatedData['path_file'] = "";

        Post::where('id', $request->id)->update($validatedData);
        return redirect('/admin/posts')->with('success', 'Karya berhasil diupdate!');

     }

     public function destroy(Post $post){
         Post::destroy($post->id);
         return redirect('/admin/posts')->with('success', 'Karya berhasil dihapus');
     }
}
