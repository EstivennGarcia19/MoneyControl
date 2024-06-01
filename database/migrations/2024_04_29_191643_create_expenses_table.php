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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');  
            $table->date('date'); 
            $table->unsignedBigInteger('user_id');                        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
            $table->timestamps();            
            
            
            
            // $table->id();
            // $table->string('name');
            // $table->integer('price');  
            // $table->date('date'); 
            // $table->unsignedBigInteger('user_id');                        
            // $table->date('day_id'); 
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('day_id')->references('id')->on('days');
            // $table->timestamps();
        });

        DB::unprepared("

            CREATE TRIGGER TotalPerDay
                BEFORE INSERT ON expenses
                FOR EACH ROW                   
                BEGIN

                    DECLARE suma bigint;
                    DECLARE _total_ bigint;
                    DECLARE _date_ date;

                    SET _date_ = new.date;

                    IF NOT EXISTS (SELECT * FROM days where date = _date_ and user_id = NEW.user_id) THEN 
                
                        INSERT into days (date, total, user_id) values (_date_, NEW.price, NEW.user_id);     
                
                    ELSE
                
                        SELECT SUM(price) INTO suma FROM expenses WHERE date = _date_ and user_id = NEW.user_id; 
                        SET _total_ = suma + NEW.price;                       
            
            
                        UPDATE days SET total = _total_ WHERE date = _date_ and user_id = NEW.user_id ;
                
                
                
                    END IF;                               
                
                END
        ");


        // DB::unprepared("

        //     CREATE TRIGGER TotalPerDay
        //         BEFORE INSERT ON expenses
        //         FOR EACH ROW                   
        //         BEGIN

        //             DECLARE total_ bigint;
        //             DECLARE TOTAL_TOTAL bigint;
        //             DECLARE fecha_ date;
        //             set fecha_ = new.date;

        //             IF NOT EXISTS (SELECT * FROM days where id = fecha_) THEN 
                
        //                 INSERT into days (id, total) values (fecha_, new.price);     
                
        //             ELSE
                
        //                 SELECT SUM(price) INTO total_ FROM expenses WHERE day_id = fecha_; 
        //                 SET TOTAL_TOTAL = total_ + new.price;
            
            
        //                 UPDATE days SET total = TOTAL_TOTAL WHERE id = fecha_;
                
                
                
        //             END IF;                               
                
        //         END
        // ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
