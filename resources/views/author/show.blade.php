@extends('layouts.template')

@section('content')
  <section id="view-films">
    <div class="container">
      <div class="row">
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