@extends('admin/layouts/main')

@section('main')
<form action="/dashboard/posts" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="mb-3">
    <label for="judul" class="form-label">Judul</label>
    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" aria-describedby="emailHelp" name="judul" value="{{ old('judul') }}" autofocus>
    @error('judul')
      <p class="text-danger">{{ $message }}</p>
    @enderror
  </div>
  <div class="mb-3 d-none">
    <label for="slug" class="form-label">Slug</label>
    <input type="text" class="form-control" id="slug" aria-describedby="emailHelp" name="slug" disabled readonly>
  </div>
  <div class="mb-3">
    <label for="" class="form-label">Kategori : </label><br>
    <input type="radio" value="musik" id="kategori1" name="kategori"><label class="mx-1" for="kategori1">Musik</label>
    <input type="radio" value="rupa" id="kategori2" name="kategori"><label class="mx-1" for="kategori2">Rupa</label>
    <input type="radio" value="sastra" id="kategori3" name="kategori"><label class="mx-1" for="kategori3">Sastra</label>
  </div>
  <div class="mb-3">
    <label class="form-label">Karya :</label>
    <input type="text" class="form-control" name="karya_dari" placeholder="Selly Putri">
  </div>
  <div class="mb-3">
    <img class="cover-preview img-fluid">
  </div>
  <div class="mb-3">
    <label class="form-label">Cover image:</label>
    <input type="file" class="form-control" id="coverImage" name="cover_image" onchange="coverPreview()">
  </div>
  <div class="mb-3">
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
        <input id="deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi') }}">
        <trix-editor input="deskripsi"></trix-editor>
  </div>
  <button type="submit" class="btn btn-primary">Tambah Post</button>
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

  const temp = document.getElementById('kategori2');
  temp.checked = true;

  function coverPreview(){
    const file = document.querySelector('#coverImage')
    const coverPreview = document.querySelector('.cover-preview')
    coverPreview.style.display = "none"

    const path = file.value;
    const lengthPath = file.value.length;
    let type = path.substr(lengthPath-3);
    typeFile = type.toLowerCase();

    if(typeFile != "jpg" && typeFile != "png"){
          file.value = "";
          alert("Jenis file Cover Image harus (.jpg/.png)")
    }else if(typeFile == "jpg" || typeFile == "png"){
      coverPreview.style.display = 'block';
      const oFReader = new FileReader();
      oFReader.readAsDataURL(file.files[0]);
      oFReader.onload = function(oFREvent){
          coverPreview.src = oFREvent.target.result;
          coverPreview.style.width = "600px";
          coverPreview.style.height = "400px";
      };
    }
  }
  
  function filePreview(){
      //get checked radio
      let kategori = "";
      x = document.querySelectorAll('input');
      for(i=0; i<x.length; i++)
      {
          if(x[i].checked)
          {
            kategori = x[i].value;
          }
      }

      const file = document.getElementById('pathFile');
      const imgPreview = document.querySelector('.img-preview');
      const videoPreview = document.querySelector('.video-preview');
      imgPreview.style.display = 'none';
      videoPreview.style.display = 'none';

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
                videoPreview.style.width = "600px";
                videoPreview.style.height = "400px";
            };
            imgPreview.style.display = "none";
          }
          else{
            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(file.files[0]);
            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result;
                imgPreview.style.width = "600px";
                imgPreview.style.height = "400px";
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
              videoPreview.style.width = "600px";
              videoPreview.style.height = "400px";
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