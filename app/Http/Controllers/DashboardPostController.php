<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->kategori == "musik"){
            $rules = [
                'judul' => 'required|max:255',
                'kategori' => 'required', 
                'path_file' => 'mimes:mp4',
                'cover_image' => 'image',
                'deskripsi' => 'required'
            ];
        }
        if($request->kategori == "rupa"){
            $rules = [
                'judul' => 'required|max:255',
                'kategori' => 'required', 
                'path_file' => 'mimes:mp4,jpg,png',
                'cover_image' => 'image',
                'deskripsi' => 'required'
            ];
        }
        if($request->kategori == "sastra"){
            $rules = [
                'judul' => 'required|max:255',
                'kategori' => 'required', 
                'path_file' => 'mimes:pdf',
                'cover_image' => 'image',
                'deskripsi' => 'required'
            ];
        }

        $validatedData = $request->validate($rules);
        // jika file kosong
        $validatedData['path_file'] = "";

        if($request->file('path_file') && $request->kategori == "musik")
        {
            $validatedData['path_file'] = $request->file('path_file')->store('file-karya/musik');
        }
        if($request->file('path_file') && $request->kategori == "rupa")
        {
            $validatedData['path_file'] = $request->file('path_file')->store('file-karya/rupa');
        }
        if($request->file('path_file') && $request->kategori == "sastra")
        {
            $validatedData['path_file'] = $request->file('path_file')->store('file-karya/sastra');
        } 

        $validatedData['cover_image'] = "";
        if($request->file('cover_image')){
            $validatedData['cover_image'] = $request->file('cover_image')->store('file-cover');
        }
        
        $validatedData['type_file'] = $request->file('path_file')->extension();
        $validatedData['karya_dari'] = $request->karya_dari;

        Post::create($validatedData);
        return redirect('/admin/posts')->with('success', 'Post baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        return view('admin/preview', [
            'title' => "Preview",
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('/admin/edit', [
            'title' => "Edit",
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if($request->kategori == "musik"){
            $rules = [
                'kategori' => 'required', 
                'path_file' => 'mimes:mp4',
                'cover_image' => "image",
                'deskripsi' => 'required'
            ];
        }
        if($request->kategori == "rupa"){
            $rules = [
                'kategori' => 'required', 
                'path_file' => 'mimes:mp4,jpg,png',
                'cover_image' => "image",
                'deskripsi' => 'required'
            ];
        }
        if($request->kategori == "sastra"){
            $rules = [
                'kategori' => 'required', 
                'path_file' => 'mimes:pdf',
                'cover_image' => "image",
                'deskripsi' => 'required'
            ];
        }

        if($request->judul != $post->judul){
            $rules['judul'] = 'required|max:255|unique:posts';
        }

        $validatedData = $request->validate($rules);

        if($request->file('cover_image'))
        {
            if($request->oldCover){
                Storage::delete($request->oldCover);
            }
            $validatedData['cover_image'] = $request->file('cover_image')->store('file-cover');
        }
        if($request->file('path_file')){
            if($request->kategori == "musik"){
                if($request->oldFile){
                    Storage::delete($request->oldFile);
                }
                $validatedData['path_file'] = $request->file('path_file')->store('file-karya/musik');
            }
            else if($request->kategori == "rupa"){
                if($request->oldFile){
                    Storage::delete($request->oldFile);
                }
                $validatedData['path_file'] = $request->file('path_file')->store('file-karya/rupa');
            }else if($request->kategori == "sastra"){
                if($request->oldFile){
                    Storage::delete($request->oldFile);
                }
                $validatedData['path_file'] = $request->file('path_file')->store('file-karya/sastra');
            }
            $validatedData['type_file'] = $request->file('path_file')->extension();
        }

        $validatedData['karya_dari'] = $request->karya_dari;


        Post::where('id', $post->id)->update($validatedData);
        return redirect('/admin/posts')->with('success', 'Post berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->path_file){
            Storage::delete($post->path_file);
        }
        if($post->cover_image){
            Storage::delete($post->cover_image);
        }
        Post::destroy($post->id);

        return redirect('/admin/posts')->with('success', "Post berhasil dihapus");
    }
}
