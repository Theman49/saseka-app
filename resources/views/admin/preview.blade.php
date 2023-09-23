@extends('admin/layouts/main')
@section('main')
    <div>
        <h2>{{ $post->judul }}</h2>
        <h5>Kategori : {{ ucfirst($post->kategori) }}</h5>
        <h5>Karya : {{ $post->karya_dari }}</h5>
    </div>
    <div class="row my-3">
        <div class="col-sm-12 col-md-6">
            <h1>File</h1>
            @if($post->path_file && ($post->type_file == "png" || $post->type_file == "jpg"))
                <img src="http://saseka-app.test/storage/{{ $post->path_file }}" class="w-100" alt="">
            @elseif($post->path_file && $post->type_file == "mp4")
                <video src="http://saseka-app.test/storage/{{ $post->path_file }}" class="w-100" controls allowfullscreen></video>
            @elseif($post->path_file && $post->type_file == "pdf")
                <iframe src="http://saseka-app.test/storage/{{ $post->path_file }}" class="w-100" height="400"></iframe>
            @endif
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="mb-3">
                <h1>Cover</h1>
                @if($post->cover_image)
                    <img src="{{ asset('storage/'.$post->cover_image) }}" class="cover-preview img-fluid" alt="" width="600" height="600">
                @endif
            </div>
        </div>

    </div>
    <p class="mt-3">{!! $post->deskripsi !!}</p>
@endsection