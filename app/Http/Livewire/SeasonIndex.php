<?php

namespace App\Http\Livewire;

use App\Models\Season;
use App\Models\Serie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class SeasonIndex extends Component
{
    use WithPagination;

    public Serie $serie;

    public $seasonNumber;

    // generate season

    public function generateSeason()
    {
        $newSeason = Http::get('https://api.themoviedb.org/3/tv/'. $this->serie->tmdb_id . '/season/'. $this->seasonNumber .'?api_key=8a11aac3fb4ef5f1f9607ee7e0329793&language=en-US
                    ')->json();
        $season = Season::where('tmdb_id', $newSeason['id'])->first();
        if (!$season) {
            Season::create([
             'serie_id' =>$this->serie->id,
            'tmdb_id' => $newSeason['id'],
            'name'    => $newSeason['name'],
            'slug'    => Str::slug($newSeason['name']),
            'season_number' => $newSeason['season_number'],
            'poster_path'  => $newSeason['poster_path'] ? $newSeason['poster_path'] : $this->serie->poster_path
        ]);
            $this->reset('seasonNumber');
            $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Season created']);
        } else {
            $this->dispatchBrowserEvent('banner-message', ['style' => 'danger', 'message' => 'Season exists']);
        }
    }

    public function render()
    {
        return view('livewire.season-index', [
            'seasons' => Season::where('serie_id', $this->serie->id)->paginate(5)
        ]);
    }
}
