<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class AuthorViewModel extends ViewModel
{
    public $author;

    public $credits;

    public function __construct($author, $credits)
    {
        $this->author = $author;
        $this->credits = $credits;
    }

    public function author()
    {
        return collect($this->author)->merge([
            'birthday' => Carbon::parse($this->author['birthday'])->format('d M, Y'),
            'age' => Carbon::parse($this->author['birthday'])->age,
            'profile_path' => $this->author['profile_path']
                ? 'https://image.tmdb.org/t/p/w300/'.$this->author['profile_path']
                : 'https://via.placeholder.com/300x450',
        ])->only([
            'birthday', 'age', 'profile_path', 'name', 'id', 'homepage', 'place_of_birth', 'biography'
        ]);
    }

    public function knownForMovies()
    {
        $castMovies = collect($this->credits)->get('cast');

        return collect($castMovies)->sortByDesc('popularity')->take(4)->map(function($movie) {
            if (isset($movie['title'])) {
                $title = $movie['title'];
            } elseif (isset($movie['name'])) {
                $title = $movie['name'];
            } else {
                $title = 'Untitled';
            }

            $url = '';
            if($movie['media_type'] == 'movie'){
                $url = route('movies.show', $movie['id']);
            }elseif($movie['media_type'] == 'tv'){
                $url = route('tv.show', $movie['id']);
            }
            return collect($movie)->merge([
                'poster_path' => $movie['poster_path']
                    ? 'https://image.tmdb.org/t/p/w185'.$movie['poster_path']
                    : 'https://via.placeholder.com/185x278',
                'title' => $title,
                'linkToPage' => $url
            ])->only([
                'poster_path', 'title', 'id', 'media_type', 'linkToPage',
            ]);
        });
    }


    public function credits()
    {
        $castMovies = collect($this->credits)->get('cast');

        return collect($castMovies)->map(function($movie) {
            if (isset($movie['release_date'])) {
                $releaseDate = $movie['release_date'];
            } elseif (isset($movie['first_air_date'])) {
                $releaseDate = $movie['first_air_date'];
            } else {
                $releaseDate = '';
            }

            if (isset($movie['title'])) {
                $title = $movie['title'];
            } elseif (isset($movie['name'])) {
                $title = $movie['name'];
            } else {
                $title = 'Untitled';
            }

            $url = '';
            if($movie['media_type'] == 'movie'){
                $url = route('movies.show', $movie['id']);
            }elseif($movie['media_type'] == 'tv'){
                $url = route('tv.show', $movie['id']);
            }

            return collect($movie)->merge([
                'release_date' => $releaseDate,
                'release_year' => isset($releaseDate) ? Carbon::parse($releaseDate)->format('Y') : 'Future',
                'title' => $title,
                'character' => isset($movie['character']) ? $movie['character'] : '',
                'linkToPage' => $url,
            ])->only([
                'release_date', 'release_year', 'title', 'character', 'linkToPage',
            ]);
        })->sortByDesc('release_date');
    }
}