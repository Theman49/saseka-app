@extends('layouts/main')
@section('container')
    <div class="container mt-4" id="karya">
        <div>
            <h2>{{ $post->judul }}</h2>
            <h5>Karya : {{ $post->karya_dari }}</h5>
            <h5>Kategori : {{ ucfirst($post->kategori) }}</h5>
        </div>
        <div class="row my-3">
                @if($post->path_file && ($post->type_file == "png" || $post->type_file == "jpg"))
                    <img src="http://saseka-app.test/storage/{{ $post->path_file }}" class="w-100" alt="">
                @elseif($post->path_file && $post->type_file == "mp4")
                    <video src="http://saseka-app.test/storage/{{ $post->path_file }}" class="w-100" controls allowfullscreen></video>
                @elseif($post->path_file && $post->type_file == "pdf")
                    <iframe src="http://saseka-app.test/storage/{{ $post->path_file }}" class="w-100" height="400"></iframe>
                @endif
        </div>
        <p class="mt-3 deskripsi">{!! $post->deskripsi !!}</p>
        <p class="btn btn-light mt-5" onclick="goBack()"><i class="bi bi-arrow-left me-2"></i>Kembali</p>
    </div>

@endsection