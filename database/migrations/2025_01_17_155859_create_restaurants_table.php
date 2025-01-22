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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nom');
            $table->string('adress');
            $table->string('description')->nullable();
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('banner_img');
            $table->string('logo_img');
            $table->string('devise');
            $table->tinyInteger('livraison')->default(0);
            $table->tinyInteger('sur_place')->default(0);
            $table->string('slogan')->nullable();
            $table->longText('legal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
