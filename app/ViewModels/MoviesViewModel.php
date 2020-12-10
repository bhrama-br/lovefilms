<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Carbon\Carbon;

class MoviesViewModel extends ViewModel
{   
    public $movies;
    public $genres;

    public function __construct($movies, $genres)
    {
        $this->movies = $movies;
        $this->genres = $genres;
    }

    public function movies(){
        return $this->formatMovies($this->movies);
    }

    public function genres(){
        // Trabalhando para retornar coleção para view
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatMovies($movies)
    {   // Trabalhando para retornar coleção para view
        return collect($movies)->map(function($movie) {
            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($movie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'],
                'vote_average' => $movie['vote_average'] * 10 .'%',
                'release_date' => Carbon::parse($movie['release_date'])->format('d M, Y'),
                'genres' => $genresFormatted,
            ])->only([
                'poster_path', 'id', 'genre_ids', 'title', 'vote_average', 'overview', 'release_date', 'genres',
            ]);
        });
    }
}
