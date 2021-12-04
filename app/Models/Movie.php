<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Movie extends Model
{
    use HasFactory;
    use Sortable;

    protected $dates = [''];

    protected $fillable = [
        'tmdb_id',
        'title',
        'runtime',
        'release_date',
        'lang',
        'rating',
        'overview',
        'poster_path',
        'video_format',
        'is_public',
        'backdrop_path',
        'slug'
    ];

    public $sortable = [
        'id',
        'title',
        'visits',
        'rating',
        'created_at',
        'updated_at'
    ];
}
