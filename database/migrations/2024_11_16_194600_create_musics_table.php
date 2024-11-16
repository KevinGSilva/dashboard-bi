<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('musics', function (Blueprint $table) {
            $table->id();
            $table->string('track');
            $table->string('artist');
            $table->string('album');
            $table->year('year');
            $table->integer('duration');
            $table->tinyInteger('time_signature');
            $table->decimal('danceability', 5, 3);
            $table->decimal('energy', 5, 3);
            $table->tinyInteger('key');
            $table->decimal('loudness', 6, 3);
            $table->boolean('mode');
            $table->decimal('speechiness', 5, 4);
            $table->decimal('acousticness', 6, 5);
            $table->decimal('instrumentalness', 6, 5);
            $table->decimal('liveness', 5, 3);
            $table->decimal('valence', 5, 3);
            $table->decimal('tempo', 6, 3);
            $table->integer('popularity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('musics');
    }
};
