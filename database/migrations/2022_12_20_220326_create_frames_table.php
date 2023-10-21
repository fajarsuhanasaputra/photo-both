<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {
        Schema::create('frames', function (Blueprint $table) {
            $table->id();
            $table->string('name', 25);
            $table->string('size')->nullable();
            $table->string('img_frame')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('frames');
    }
};
