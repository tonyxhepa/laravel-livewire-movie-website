<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('tmdb_id')->unique();
            $table->string('title');
            $table->date('release_date');
            $table->string('runtime');
            $table->string('lang');
            $table->string('video_format');
            $table->boolean('is_public')->default(0);
            $table->bigInteger('visits')->default(1);
            $table->string('slug');
            $table->decimal('rating', 8,1);
            $table->string('poster_path');
            $table->string('backdrop_path')->nullable();
            $table->text('overview');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
