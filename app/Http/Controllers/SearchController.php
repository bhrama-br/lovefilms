<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\ViewModels\SearchViewModel;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($search)
    {
        $search = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/search/multi?query='.$search)
                            ->json()['results'];

        $viewModel = new SearchViewModel(
            $search
        );


        return view('search/index',$viewModel);
    }

}
