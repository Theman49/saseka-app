@extends('admin/layouts/main')
@section('main')
    @if(session()->has('success'))
        <div class="alert alert-success my-5" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <a href="/admin/posts/insert" class="btn btn-primary mb-3">Tambah Post</a>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Judul</th>
            <th scope="col">Kategori</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $number = 0; ?>
            @foreach ($posts as $post)
            <?php $number += 1 ?>
            <tr>
                <th scope="row">{{ $number }}</th>
                <td>{{ $post->judul }}</td>
                <td>{{ $post->kategori }}</td>
                <td>
                    <a href="/dashboard/posts/{{ $post->slug }}" class="col badge bg-info"><span data-feather="eye"></span></a>
                    <a href="/dashboard/posts/{{ $post->slug }}/edit" class="col badge bg-warning"><span data-feather="edit"></span></a>
                    <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="border-0 col badge bg-danger" onclick="return confirm('Anda yakin ingin menghapus ' + '{{ $post->judul }}' + ' ?')"><span data-feather="x-circle"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


@endsection