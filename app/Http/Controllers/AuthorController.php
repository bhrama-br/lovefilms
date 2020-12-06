<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\ViewModels\AuthorViewModel;

class AuthorController extends Controller
{
    
    
    public function show($id)
    {
        $author = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/person/'.$id)
                            ->json();

        $credits = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/'.$id.'/combined_credits')
            ->json();

        

        $viewModel = new AuthorViewModel(
            $author,
            $credits
        );


        return view('author/show', $viewModel);
    }
}
