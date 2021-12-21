<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Movie;
use App\Models\Serie;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $movies = Movie::orderBy('updated_at', 'desc')->take(12)->get();
        $series = Serie::withCount('seasons')->orderBy('created_at', 'desc')->take(12)->get();
        $episodes = Episode::orderBy('created_at', 'desc')->take(12)->get();

        return view('welcome', compact('movies', 'series', 'episodes'));
    }
}
