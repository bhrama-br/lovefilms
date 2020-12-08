@extends('layouts.template')

@section('content')
  <section id="view-films">
    <div class="container">
      <div class="row">
        <div class="col-md-6 text-md-left text-center mb-3">
          <small>Share:</small>
          <a href="https://www.facebook.com/sharer/sharer.php?u={{route('author.show', $author['id'])}}" class="facebook" target="_blank">
            <i class="fab fa-facebook-f"></i>
          </a>

          <a href="https://www.linkedin.com/shareArticle?mini=true&url={{route('author.show', $author['id'])}}" target="_blank">
            <i class="fab fa-linkedin-in"></i>
          </a>

          <a href="https://api.whatsapp.com/send?text={{route('author.show', $author['id'])}}" target="_blank">
            <i class="fab fa-whatsapp"></i>
          </a>

        </div>
        <div class="col-md-6 text-md-right text-center">
          <a href="{{ route('export', $author['id'])}}" class="btn btn-primary btn-love">
            Export PPT
          </a>
        </div>

        <div class="col-md-4">
          <img src="{{ $author['profile_path'] }}" alt="{{ $author['name'] }}" class="img-fluid">
        </div>

        <div class="col-md-8 text-center text-md-left p-4">
          <h3 class="title">{{ $author['name'] }}</h3>
          <p class="star mb-5">
            <i class="fas fa-birthday-cake"></i>
            <span class="value-percen">{{ $author['birthday'] }}</span> in
            <span class="date">{{ $author['place_of_birth'] }}</span> 
          </p>

          <p class="sobre mb-5">
            {{ $author['biography'] }}
          </p>

          <h3 class="title-popular">Popular</h3>
          <div class="row">
            @foreach ($knownForMovies as $movie)
              <div class="col-md-3 mt-4">
                  <a href="{{ $movie['linkToPage'] }}">
                    <img src="{{ $movie['poster_path'] }}" alt="poster" class="img-fluid">
                  </a>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>"
  </section>

  <section id="cast">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-3">
          <h3 class="title-popular">Films</h3>
          @foreach ($credits as $credit)
            <p>
              {{ $credit['release_year'] }} -
              <strong><a href="{{ $credit['linkToPage'] }}" class="hover:underline">{{ $credit['title'] }}</a></strong>
            </p>
          @endforeach
        </div>
      </div>
    </div>
  </section>
@endsection