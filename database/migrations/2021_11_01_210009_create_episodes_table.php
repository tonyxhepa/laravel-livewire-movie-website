<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
             $table->bigInteger('tmdb_id')->unique();
            $table->foreignId('season_id')->constrained();
            $table->string('name');
            $table->integer('episode_number');
            $table->boolean('is_public')->default(0);
            $table->bigInteger('visits')->default(1);
            $table->string('slug');
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
        Schema::dropIfExists('episodes');
    }
}
