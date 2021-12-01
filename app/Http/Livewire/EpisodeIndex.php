<?php

namespace App\Http\Livewire;

use App\Models\Episode;
use App\Models\Season;
use App\Models\Serie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class EpisodeIndex extends Component
{

    public Serie $serie;
    public Season $season;

    public $episodeNumber;
    // generate season

    public function generateEpisode()
    {
        $newEpisode = Http::get('https://api.themoviedb.org/3/tv/' . $this->serie->tmdb_id . '/season/' . $this->season->season_number .'/episode/'. $this->episodeNumber . '?api_key=8a11aac3fb4ef5f1f9607ee7e0329793&language=en-US
                    ');
        if ($newEpisode->ok()) {

            $episode = Episode::where('tmdb_id', $newEpisode['id'])->first();
            if (!$episode) {
                Episode::create([
                    'season_id' => $this->season->id,
                    'tmdb_id' => $newEpisode['id'],
                    'name'    => $newEpisode['name'],
                    'slug'    => Str::slug($newEpisode['name']),
                    'episode_number' => $newEpisode['episode_number'],
                    'overview'  => $newEpisode['overview'],
                    'is_public' => false,
                    'visits'    => 1 
                ]);
                $this->reset('episodeNumber');
                $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Episode created']);
            } else {
                $this->dispatchBrowserEvent('banner-message', ['style' => 'danger', 'message' => 'Episode exists']);
            }
        } else {
            $this->dispatchBrowserEvent('banner-message', ['style' => 'danger', 'message' => 'Api not exists']);
            $this->reset('seasonNumber');
        }
    }

    public function render()
    {
        return view('livewire.episode-index', [
            'episodes' => Episode::paginate(5)
        ]);
    }
}
