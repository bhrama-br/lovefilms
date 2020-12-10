<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\ViewModels\AuthorViewModel;

class AuthorController extends Controller
{
    
    
    public function show($id)
    {
        // Requisição Pesquisar id do Autor
        $author = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/person/'.$id)
                            ->json();

        // Requisição Pesquisar id do Autor retornar Creditos
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
