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
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('amount');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        DB::unprepared('

            CREATE TRIGGER StalkerIncomes
                AFTER INSERT ON incomes
                FOR EACH ROW                  
        
                BEGIN
                    DECLARE cantidad int(12);
                    DECLARE id_user int;
                    
                    SET cantidad = new.amount;
                    SET id_user = new.user_id;
                
                    INSERT INTO stalker_incomes (amount, date, user_id) VALUES (cantidad, NEW.date , id_user);
                END       
        
        
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
