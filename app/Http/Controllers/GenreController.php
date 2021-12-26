<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function show(Genre $genre)
    {
        $movies = $genre->movies()->paginate('18');

        return view('genres.show', compact('movies', 'genre'));
    }
}
