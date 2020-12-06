<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class SearchViewModel extends ViewModel
{
  public $search;

  public function __construct($search)
  {
    $this->search = $search;
  }

  public function search(){
    return $this->formatSearch($this->search);
  }

  private function formatSearch($search)
  {
      return collect($search)->map(function($s) {

        $img = '';
        $title = '';

        if($s['media_type'] == 'person'){
          $img = $s['profile_path'];
          $title = $s['name'];
        }elseif($s['media_type'] == 'movie'){
          $img = $s['poster_path'];
          $title = $s['title'];
        }elseif($s['media_type'] == 'tv'){
          $img = $s['poster_path'];
          $title = $s['original_name'];
        }

        return collect($s)->merge([
          'poster_path' => $img
                ? 'https://image.tmdb.org/t/p/w300/'.$img
                : 'https://via.placeholder.com/300x450',
          'title' => $title
        ])->only([
            'poster_path', 'id', 'title', 'media_type'
        ]);

      });
  }
}