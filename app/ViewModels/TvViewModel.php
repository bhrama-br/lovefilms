<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public $movie;

    public function __construct($movie)
    {
        $this->movie = $movie;
    }

    public function movie()
    {   

        return collect($this->movie)->merge([
            'poster_path' => $this->movie['poster_path']
                ? 'https://image.tmdb.org/t/p/w500/'.$this->movie['poster_path']
                : 'https://via.placeholder.com/500x750',
            'vote_average' => $this->movie['vote_average'] * 10 .'%',
            'release_date' => Carbon::parse($this->movie['first_air_date'])->format('d M, Y'),
            'genres' => collect($this->movie['genres'])->pluck('name')->flatten()->implode(', '),
            'backdrops' => collect($this->movie['images']['backdrops'])->take(15),
            'title' => $this->movie['original_name']
        ])->only([
            'poster_path', 'id', 'genres', 'title', 'vote_average', 'overview', 'release_date', 'credits' ,
            'videos', 'images', 'crew', 'cast', 'images'
        ]);
    }
}