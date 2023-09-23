@if($title != "Home")
<div class="container p-0">
  <nav class="navbar navbar-expand-lg navbar-dark bg-darkj">
    <div class="container-fluid">
      
      <a class="navbar-brand" href="{{ url('home') }}"><img src="/logo.png" class="logo-navbar" alt=""></a>
    
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav text-center">
          <a class="nav-link {{ ($title == 'Home') ? 'active' : '' }}" href="{{ url('home') }}">Home</a>
          <a class="nav-link {{ ($title == 'Musik') ? 'active' : '' }}" href="{{ url('musik') }}">Musik</a>
          <a class="nav-link {{ ($title == 'Rupa') ? 'active' : '' }}" href="{{ url('rupa') }}">Rupa</a>
          <a class="nav-link {{ ($title == 'Sastra') ? 'active' : '' }}" href="{{ url('sastra') }}">Sastra</a>
        </div>
      </div>
    </div>
  </nav>
</div>
@else
  <nav class="navbar navbar-expand-lg navbar-dark bg-darkj">
    <div class="container-fluid">
      
      <a class="navbar-brand" href="{{ url('home') }}"><img src="/logo.png" class="logo-navbar" alt=""></a>
    
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav text-center">
          <a class="nav-link {{ ($title == 'Home') ? 'active' : '' }}" href="{{ url('home') }}">Home</a>
          <a class="nav-link {{ ($title == 'Musik') ? 'active' : '' }}" href="{{ url('musik') }}">Musik</a>
          <a class="nav-link {{ ($title == 'Rupa') ? 'active' : '' }}" href="{{ url('rupa') }}">Rupa</a>
          <a class="nav-link {{ ($title == 'Sastra') ? 'active' : '' }}" href="{{ url('sastra') }}">Sastra</a>
        </div>
      </div>
    </div>
  </nav>
@endif