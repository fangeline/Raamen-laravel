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
        Schema::create('ramens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meat_id');
            $table->foreign('meat_id')->references('id')->on('meats');
            $table->string('name');
            $table->string('broth');
            $table->integer('price')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ramens');
    }
};
