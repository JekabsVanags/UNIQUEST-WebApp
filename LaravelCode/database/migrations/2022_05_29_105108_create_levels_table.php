<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->string('coverImage');
            $table->text('description');
            $table->integer('rating');
            $table->boolean('isPublic');
            $table->integer('dificulty');
            $table->foreignID('user_id')->constrained()->onDelete('cascade');
            $table->foreignID('location_id')->constrained()->onDelete('cascade');
            $table->foreignID('level_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('levels');
    }
};
