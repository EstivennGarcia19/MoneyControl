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
            $table->foreign('user_id')->references('id')->on('users');
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
        
        DB::unprepared("        

            CREATE TRIGGER StalkerChest
            BEFORE UPDATE ON chests
            FOR EACH ROW
            BEGIN            
                DECLARE accion VARCHAR(9);
                DECLARE amount_diff INT;
                DECLARE id_cofre INT(4);  
            
                SET id_cofre = OLD.id;
                SET amount_diff = NEW.amount - COALESCE(OLD.amount, 0);
            
                IF amount_diff < 0 THEN
                    SET accion = 'Removed';
                ELSE
                    SET accion = 'Added';
                END IF;
            
                INSERT INTO stalker_chests (action_per, amount, chest_id, created_at) VALUES (accion, ABS(amount_diff), id_cofre, CURRENT_TIMESTAMP);    
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
