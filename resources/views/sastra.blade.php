@extends('layouts/main')
@section('container')
    <div class="container mt-5">
        <div class="grid">
            @foreach($posts as $post)
                <div class="item" onclick="goTo('/post/{{ $post->slug }}')">
                        <img src="{{ asset('storage/'.$post->cover_image) }}" alt="" class="cover">
                        <a href="/post/{{ $post->slug }}" class="judul">{{ $post->judul }}</a>
                </div>
            @endforeach
        </div>

    </div>
@endsection