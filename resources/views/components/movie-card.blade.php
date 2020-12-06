<div class="col-md-3 mb-3">
    <a href="{{ route('movies.show', $movie['id']) }}" class="link-card">
        <div class="card">
        <div class="card-img">
            <img src="{{ $movie['poster_path'] }}" class="card-img-top" alt="Titulo">
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $movie['title'] }}</h5>
            <p class="card-star">
            <i class="fas fa-star"></i>
            <span class="value-percen">{{ $movie['vote_average'] }}</span> | 
            <span class="date">{{ $movie['release_date'] }}</span>
            </p>
            <p class="card-text">
                {{ $movie['genres'] }}
            </p>
        </div>
        </div>
    </a>
</div>