<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;


class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {   
        // Get all Movies
        $moviesAll = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/movie/popular')
                            ->json()['results'];
        // Get all Genres 
        $genres = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/genre/movie/list')
                            ->json()['genres'];
        
        
        $viewModel = new MoviesViewModel(
            $moviesAll,
            $genres
        );

        return view('movies/index', $viewModel);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // Get Movie select
        $movie = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/movie/'.$id.'?append_to_response=credits,videos,images')
                            ->json();

        $viewModel = new MovieViewModel($movie);


        return view('movies/show', $viewModel);
    }

}
