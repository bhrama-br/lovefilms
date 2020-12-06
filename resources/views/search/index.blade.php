@extends('layouts.template')

@section('content')
  <section id="card-films">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-3">
          <h3 class="title-popular">Search</h3>
        </div>
        @if(count($search) > 0)
          @foreach ($search as $s)
            <div class="col-md-4 mb-3">
              @if ($s['media_type'] == 'person')
                <a href="{{ route('author.show', $s['id']) }}" class="link-card">
              @elseif ($s['media_type'] == 'tv')
                <a href="{{ route('tv.show', $s['id']) }}" class="link-card">
              @else
                <a href="{{ route('movies.show', $s['id']) }}" class="link-card">
              @endif
                <div class="card">
                  <div class="card-img">
                    <img src="{{ $s['poster_path'] }}" class="card-img-top" alt="Titulo">
                  </div>
                  <div class="card-body">
                    <h5 class="card-title text-center">{{ $s['title'] }}</h5>
                      
                  </div>
                </div>
              </a>
            </div>
          @endforeach
        @else
            <div class="col-md-4 text-center mx-auto mb-3">
              <h3>No results</h3>
            </div>
        @endif
      </div>
    </div>
  </section>
@endsection