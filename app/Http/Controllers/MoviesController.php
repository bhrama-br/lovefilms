<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;


class MoviesController extends Controller
{
    public function index()
    {   
        // Retornar todos filmes da API
        $moviesAll = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/movie/popular')
                            ->json()['results'];
        // Retornar todos generos de filmes
        $genres = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/genre/movie/list')
                            ->json()['genres'];
        
        
        $viewModel = new MoviesViewModel(
            $moviesAll,
            $genres
        );

        return view('movies/index', $viewModel);
    }

    
    public function show($id)
    {

        // Retornar filme
        $movie = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/movie/'.$id.'?append_to_response=credits,videos,images')
                            ->json();

        $viewModel = new MovieViewModel($movie);


        return view('movies/show', $viewModel);
    }

}
