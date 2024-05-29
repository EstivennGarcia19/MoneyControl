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
        Schema::create('stalker_chests', function (Blueprint $table) {
            $table->id();
            $table->string('action_per');
            $table->integer('amount')->nullable();
            $table->integer('chest_id');   
            $table->timestamps();  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stalker_chests');
    }
};
