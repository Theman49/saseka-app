@extends('layouts/main')
@section('container')
<div id="carouselExampleIndicators" class="carousel slide banner" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
        <img src="https://source.unsplash.com/random?art" class="d-block w-100" alt="...">
        <h1 class="banner-text">Rupa</h1>
    </div>
    <div class="carousel-item">
        <img src="https://source.unsplash.com/random?music" class="d-block w-100" alt="...">
        <h1 class="banner-text">Musik</h1>
    </div>
    <div class="carousel-item">
        <img src="https://source.unsplash.com/random?history" class="d-block w-100" alt="...">
        <h1 class="banner-text">Sastra</h1>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<div class="container">
    <section class="naskah my-3">
        <h1 class="u-line-title">Naskah</h1>

        <div class="naskah__showcase">
            @foreach($posts as $post)
                @if($post->kategori == "sastra")
                    <div class="naskah__item">
                        <img src="{{ asset('storage/'.$post->cover_image) }}" alt="" class="naskah__cover">
                        <a href="/post/{{ $post->slug }}" class="naskah__judul">{{ $post->judul }}</a>
                        <div class="naskah__deskripsi">{{ $post->kategori }}</div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="naskah__button">
            <a href="/sastra" class="btn btn-light">View All...</a>
        </div>

    </section>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="text/javascript" src="/slick/slick.min.js"></script>
<script>
    $(document).ready(function(){
        $('.naskah__showcase').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            autoplay: true,
            slidesToScroll: 4,
            responsive: [
                {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
                },
                {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
                },
                {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
                }]
        });
    });
		
</script>
@endsection