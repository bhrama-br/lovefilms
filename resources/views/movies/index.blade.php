@extends('layouts.template')

@section('content')
  <section id="card-films">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-3">
          <h3 class="title-popular">POPULAR MOVIES</h3>
        </div>
        @foreach ($movies as $movie)
          <x-movie-card :movie="$movie"/>
        @endforeach

      </div>
    </div>
  </section>
@endsection