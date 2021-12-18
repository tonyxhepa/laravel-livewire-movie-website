<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = ['season_id', 'tmdb_id', 'name', 'slug', 'episode_number', 'overview', 'is_public', 'visits'];

    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
