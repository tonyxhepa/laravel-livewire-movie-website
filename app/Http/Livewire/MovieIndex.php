<?php

namespace App\Http\Livewire;

use App\Models\Movie;
use Livewire\Component;

class MovieIndex extends Component
{
    public function render()
    {
        return view('livewire.movie-index', [
            'movies' => Movie::paginate(5)
        ]);
    }
}
