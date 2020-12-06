<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\ViewModels\TvViewModel;
class TvController extends Controller
{
    
    public function show($id)
    {
        // Get Movie select
        $movie = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/tv/'.$id.'?append_to_response=credits,videos,images')
                            ->json();

        $viewModel = new TvViewModel($movie);


        return view('movies/tv', $viewModel);
    }

}
