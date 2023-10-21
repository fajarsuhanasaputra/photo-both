<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code', 25);
            $table->string('price', 7);
            $table->string('max_use', 4)->default(0);
            $table->date('start');
            $table->date('expired');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('vouchers');
    }
};
