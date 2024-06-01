<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chests', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('amount')->nullable();
            $table->date('date')->nullable();
            $table->string('color');
            $table->unsignedBigInteger('user_id');  
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
            $table->timestamps();
        });

        DB::unprepared("        

            CREATE TRIGGER StalkerChestDelete
            BEFORE DELETE ON chests
            FOR EACH ROW
            BEGIN
	            DELETE FROM stalker_chests WHERE chest_id = old.id;
            END         
        ");
        
      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chests');
    }
};
