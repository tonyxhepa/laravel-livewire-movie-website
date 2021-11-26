<?php

namespace App\Http\Livewire;

use App\Models\Serie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class SerieIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'asc';
    public $perPage = 5;

    public $name;
    public $tmdbId;
    public $createdYear;
    public $posterPath;
    public $showSerieModal = false;
    public $serieId;

    protected $rules = [
        'name' => 'required',
        'posterPath' => 'required',
        'createdYear' => 'required'
    ];

    public function generateSerie()
    {
        $newSerie = Http::get('https://api.themoviedb.org/3/tv/'. $this->tmdbId .'?api_key=8a11aac3fb4ef5f1f9607ee7e0329793&language=en-US
                    ')->json();
        $serie = Serie::where('tmdb_id', $newSerie['id'])->first();
        if (!$serie) {
            Serie::create([
            'tmdb_id' => $newSerie['id'],
            'name'    => $newSerie['name'],
            'slug'    => Str::slug($newSerie['name']),
            'created_year' => $newSerie['first_air_date'],
            'poster_path'  => $newSerie['poster_path']
        ]);
            $this->reset();
            $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Serie created']);
        } else {
            $this->dispatchBrowserEvent('banner-message', ['style' => 'danger', 'message' => 'Serie exists']);
        }
    }

    public function showEditModal($id)
    {
        $this->serieId = $id;
        $this->loadSerie();
        $this->showSerieModal = true;
    }
    public function loadSerie()
    {
        $serie = Serie::findOrFail($this->serieId);
        $this->name = $serie->name;
        $this->posterPath = $serie->poster_path;
        $this->createdYear = $serie->created_year;
    }
    public function closeSerieModal()
    {
        $this->showSerieModal = false;
    }
    public function updateSerie()
    {
        $this->validate();
        $serie = Serie::findOrFail($this->serieId);
        $serie->update([
          'name' => $this->name,
          'created_year' => $this->createdYear,
          'poster_path' => $this->posterPath
      ]);
        $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Serie updated']);
        $this->reset();
    }
    public function deleteSerie($id)
    {
        $serie = Serie::findOrFail($id);
        $serie->delete();
        $this->reset();
        $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Serie deleted']);
    }
    public function resetFilters()
    {
        $this->reset();
    }
    public function render()
    {
        return view('livewire.serie-index', [
            'series' => Serie::search('name', $this->search)->orderBy('name', $this->sort)->paginate($this->perPage)
        ]);
    }
}
