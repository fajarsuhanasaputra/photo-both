<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->text('img_post', 255)->nullable();
            $table->text('content')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('posts');
    }
};
