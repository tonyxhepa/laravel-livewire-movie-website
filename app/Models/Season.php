<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = ['serie_id', 'tmdb_id', 'name', 'slug', 'season_number', 'poster_path'];
}
