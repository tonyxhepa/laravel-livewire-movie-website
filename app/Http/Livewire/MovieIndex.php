<?php

namespace App\Http\Livewire;

use App\Models\Movie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class MovieIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'asc';
    public $perPage = 5;

    public $title;
    public $runtime;
    public $lang;
    public $videoFormat;
    public $rating;
    public $posterPath;
    public $backdropPath;
    public $overview;
    public $isPublic;
    public $tmdbId;

    // generate movie

    public function generateMovie()
    {
        $movie = Movie::where('tmdb_id', $this->tmdbId)->exists();
        if ($movie) {
            $this->dispatchBrowserEvent('banner-message', ['style' => 'danger', 'message' => 'Movie exists']);
            return;
        }
        $url = 'https://api.themoviedb.org/3/movie/'. $this->tmdbId .'?api_key=8a11aac3fb4ef5f1f9607ee7e0329793&language=en-US';

        $apiMovie = Http::get($url);

        if ($apiMovie->successful()) {
            $newMovie = $apiMovie->json();

            Movie::create([
                'tmdb_id' => $newMovie['id'],
                'title' => $newMovie['title'],
                'slug'  => Str::slug($newMovie['title']),
                'runtime' => $newMovie['runtime'],
                'rating' => $newMovie['vote_average'],
                'release_date' => $newMovie['release_date'],
                'lang' => $newMovie['original_language'],
                'video_format' => 'HD',
                'is_public' => false,
                'overview' => $newMovie['overview'],
                'poster_path' => $newMovie['poster_path'],
                'backdrop_path' => $newMovie['backdrop_path']
            ]);
            $this->reset('tmdbId');
            $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Movie created']);
        } else {
            $this->dispatchBrowserEvent('banner-message', ['style' => 'danger', 'message' => 'Api not exists']);
            $this->reset('tmdbId');
        }
    }

    public function render()
    {
        return view('livewire.movie-index', [
            'movies' => Movie::search('title', $this->search)->sortable()->paginate($this->perPage)
        ]);
    }
}
