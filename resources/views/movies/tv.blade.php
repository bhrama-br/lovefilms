@extends('layouts.template')

@section('content')
  <section id="view-films">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-3">
          <small>Share:</small>
          <a href="https://www.facebook.com/sharer/sharer.php?u={{route('tv.show', $movie['id'])}}" class="facebook" target="_blank">
            <i class="fab fa-facebook-f"></i>
          </a>

          <a href="https://www.linkedin.com/shareArticle?mini=true&url={{route('tv.show', $movie['id'])}}" target="_blank">
            <i class="fab fa-linkedin-in"></i>
          </a>

          <a href="https://api.whatsapp.com/send?text={{route('tv.show', $movie['id'])}}" target="_blank">
            <i class="fab fa-whatsapp"></i>
          </a>

        </div>
        <div class="col-md-4">
          <img src="{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="img-fluid">
        </div>

        <div class="col-md-8 text-center text-md-left p-4">
          <h3 class="title">{{ $movie['title'] }}</h3>
          <p class="star mb-5">
            <i class="fas fa-star"></i>
            <span class="value-percen">{{ $movie['vote_average'] }}</span> | 
            <span class="date">{{ $movie['release_date'] }}</span> | 
            <span>
              {{ $movie['genres'] }}
              
            </span>
          </p>

          <p class="sobre mb-5">
            {{ $movie['overview'] }}
          </p>

          <div class="row">
            @foreach ($movie['credits']['crew'] as $crew)
              @if($loop->index < 6)
                <div class="col-md-4">
                  <p class="name"> {{ $crew['name'] }} </p>
                  <p class="prof"> {{ $crew['job'] }} </p>
                </div>
              @else
                @break
              @endif
            @endforeach
          </div>

          @if (count($movie['videos']['results']) > 0)
            <div class="row mt-5">
                <div class="col-md-12 text-center mx-auto">
                  <button class="btn btn-primary btn-love" data-toggle="modal" data-target=".bd-example-modal-lg">Play Trailler</button>
                </div>
            </div>
          @endif
          
        </div>
        
      </div>
    </div>"
  </section>


  <section id="cast">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-3">
          <h3 class="title-popular">Protagonists</h3>
        </div>

        @foreach($movie['credits']['cast'] as $cast)
          @if ($loop->index <= 3)
            <div class="col-md-3">
              <a href="{{ route('author.show', $cast['id']) }}">
                <div class="cart-prota">
                  <div class="cart-image">
                    @if($cast['profile_path'])
                      <img src="https://image.tmdb.org/t/p/w500/{{ $cast['profile_path'] }}" alt="" class="img-fluid">
                    @else
                      <img src="https://via.placeholder.com/500x750" alt="" class="img-fluid">
                    @endif
                  </div>
                  <p class="name-protagonist text-center mt-2">{{$cast['name']}}</p>
                  <p class="papel-protagonist text-center">{{$cast['character']}}</p>
                </div>
              </a>
            </div>
          @elseif ($loop->index == 4)
            <div class="col-md-12 text-center mt-4">
              <button class="btn btn-primary btn-love" data-toggle="modal" data-target=".viewProtagonists">View all</button>
            </div>
          @else
                @break
          @endif
        @endforeach
      </div>
    </div>
  </section>

  <section>
    <div class="container">
      <div class="row">
        @foreach($movie['images']['backdrops'] as $img)
          @if ($loop->index < 15)
            <div class="col-md-4 mb-3">
              <img src="https://image.tmdb.org/t/p/w500/{{$img['file_path']}}" alt="" class="img-fluid">
            </div>
          @else
                @break
          @endif
        @endforeach
      </div>
    </div>
  </section>


  @if (count($movie['videos']['results']) > 0)
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

          <iframe width="100%" height="500" src="https://www.youtube.com/embed/{{$movie['videos']['results'][0]['key']}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  @endif


  <div class="modal fade viewProtagonists" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="container">
          <div class="row">
            @foreach($movie['credits']['cast'] as $cast)
              <div class="col-md-4">
              
                <a href="{{ route('author.show', $cast['id']) }}">
                  <p class="name-protagonist mt-2">{{$cast['name']}}</p>
                  <p class="papel-protagonist">{{$cast['character']}}</p>
                </a>
              
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection