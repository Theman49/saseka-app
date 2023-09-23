@extends('admin/layouts/main')
@section('main')
    <form action="/dashboard/posts/{{ $post->slug }}" method="POST" enctype="multipart/form-data">
    @method('put')
    @csrf
    <div class="mb-3">
        <label for="judul" class="form-label">Judul</label>
        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" aria-describedby="emailHelp" name="judul" value="{{ old('judul', $post->judul) }}" autofocus>
        @error('judul')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3 d-none">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" class="form-control" id="slug" name="slug" value="{{ $post->slug }}" >
    </div>
    <input type="hidden" name="oldFile" value="{{ $post->path_file }}">
    <input type="hidden" name="oldCover" value="{{ $post->cover_image }}">
    <input type="hidden" name="kategori" value="{{ $post->kategori }}">
    <div class="mb-3">
        <label for="kategori" class="form-label">Kategori</label>
        <input type="text" class="form-control" id="kategori" value="{{ $post->kategori }}" disabled readonly>
        <input type="text" class="form-control d-none" id="type_file" value="{{ $post->type_file }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Karya :</label>
        <input type="text" class="form-control" name="karya_dari" value="{{ $post->karya_dari }}">
    </div>

    @if($post->cover_image)
    <div class="mb-3">
        <p>Cover image</p>
        <img class="cover-preview img-fluid" src="{{ asset('storage/'.$post->cover_image) }}">
    </div>
    @endif
    <div class="mb-3">
        <label class="form-label">Cover image:</label>
        <input type="file" class="form-control" id="coverImage" name="cover_image" onchange="coverPreview()">
    </div>

    @if($post->path_file && ($post->type_file == "jpg" || $post->type_file == "png"))
    <div class="mb-3">
        <img class="img-old-preview img-fluid d-block" src="{{ asset('storage/'.$post->path_file) }}" alt="">
    </div>
    @elseif($post->path_file && $post->type_file == "mp4")
    <div class="mb-3">
        <video class="video-old-preview d-block" src="{{ asset('storage/'. $post->path_file) }}" controls></video>
    </div>
    @elseif($post->path_file && $post->type_file == "pdf")
    <div class="mb-3">
        <iframe src="{{ asset('storage/'.$post->path_file) }}"></iframe>
    </div>
    @endif
    <div class="mb3">
        <label class="keterangan form-label">File Baru</label>
        <img class="img-preview img-fluid" alt="">
        <video class="video-preview" controls></video>
    </div>
    <div class="mb-3">
        <label for="pathFile" class="form-label">File Karya</label>
        <input class="form-control @error('path_file') is-invalid @enderror" type="file" id="pathFile" name="path_file" onchange="filePreview()">
    </div>
    @error('path_file')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            @error('deskripsi')
            <p class="text-danger">{{ $message }}</p>
            @enderror
            <input id="deskripsi" type="hidden" name="deskripsi" value="{!! old('deskripsi', $post->deskripsi) !!}">
            <trix-editor input="deskripsi"></trix-editor>
    </div>
    <button type="submit" class="btn btn-primary mb-5">Update Post</button>
    </form>

    <script>
    const title = document.getElementById('judul');
    const slug = document.getElementById('slug');

    title.addEventListener('change', function() {
        fetch('/admin/posts/insert/checkSlug?judul=' + title.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });

    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    })

    const videoPreview = document.querySelector('.video-preview');
    videoPreview.style.display = "none";
    const imgPreview = document.querySelector('.img-preview');
    imgPreview.style.display = "none";
    const keterangan = document.querySelector('.keterangan');
    keterangan.style.display = "none";

    function filePreview(){
        const kategori = document.getElementById('kategori').value;

        const file = document.getElementById('pathFile');
        const imgPreview = document.querySelector('.img-preview');
        const videoPreview = document.querySelector('.video-preview');
        const keterangan = document.querySelector('.keterangan');

        imgPreview.style.display = 'none';
        videoPreview.style.display = 'none';
        keterangan.style.display = "block";

        const path = file.value;
        const lengthPath = file.value.length;
        let type = path.substr(lengthPath-3);
        typeFile = type.toLowerCase();

        if(kategori == "rupa"){
            if(typeFile != "jpg" && typeFile != "png" && typeFile != "mp4"){
            file.value = "";
            alert("Kategori yang dipilih adalah "+kategori+", Jenis file harus image (.jpg/.png) atau video (.mp4)")
            }else if(typeFile == "jpg" || typeFile == "png" || typeFile == "mp4"){
            if(typeFile == "mp4"){
                videoPreview.style.display = 'block';
                const oFReader = new FileReader();
                oFReader.readAsDataURL(file.files[0]);
                oFReader.onload = function(oFREvent){
                    videoPreview.src = oFREvent.target.result;
                    // videoPreview.style.width = "600px";
                    // videoPreview.style.height = "400px";
                };
                imgPreview.style.display = "none";
            }
            else{
                imgPreview.style.display = 'block';
                const oFReader = new FileReader();
                oFReader.readAsDataURL(file.files[0]);
                oFReader.onload = function(oFREvent){
                    imgPreview.src = oFREvent.target.result;
                    // imgPreview.style.width = "600px";
                    // imgPreview.style.height = "400px";
                };
                videoPreview.style.display = "none";
            }
            }
        }else if(kategori == "musik"){
            if(typeFile != "mp4"){
                file.value = "";
                videoPreview.style.display = "none";
                alert("Kategori yang dipilih adalah "+kategori+", Jenis file harus .mp4")
            }else if(typeFile == "mp4"){
                videoPreview.style.display = "block";
                const oFReader = new FileReader();
                oFReader.readAsDataURL(file.files[0]);
                oFReader.onload = function(oFREvent){
                    videoPreview.src = oFREvent.target.result;
                    // videoPreview.style.width = "600px";
                    // videoPreview.style.height = "400px";
                };
            }
            imgPreview.style.display = "none";
        }else if(kategori == "sastra"){
            if(typeFile != "pdf"){
            file.value = "";
            alert("Kategori yang dipilih adalah "+kategori+", Jenis file harus .pdf")
            }
            imgPreview.style.display = "none";
            videoPreview.style.display = "none";
        }else{
            imgPreview.style.display = "none";
            videoPreview.style.display = "none";
        }

    }

    </script>
@endsection