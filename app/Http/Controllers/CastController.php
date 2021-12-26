<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use Illuminate\Http\Request;

class CastController extends Controller
{
    public function index()
    {
        $casts = Cast::orderBy('created_at', 'desc')->paginate(18);

        return view('casts.index', compact('casts'));
    }

    public function show(Cast $cast)
    {
        return view('casts.show', compact('cast'));
    }
}
