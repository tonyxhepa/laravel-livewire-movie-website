<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Season extends Model implements Searchable
{
    use HasFactory;

    protected $fillable = ['serie_id', 'tmdb_id', 'name', 'slug', 'season_number', 'poster_path'];

    public function getSearchResult(): SearchResult
    {
        $url = route('season.show', [$this->serie->slug,$this->slug]);

        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->name,
            $url
        );
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
}
