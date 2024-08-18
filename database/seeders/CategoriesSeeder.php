<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        

        DB::table('categories')->insert([
            [
                'id'=>1,
                'name'=>'Alimento'
            ], 
            [
                'id'=>2,
                'name'=>'Salud y belleza'   
            ],
            [
                'id'=>3,
                'name'=>'Entretenimiento y caprichos'  
            ],
            [
                'id'=>4,
                'name'=>'Inversiones y apuestas'   
            ],
            [
                'id'=>5,
                'name'=>'Limpieza y hogar'   
            ],
            [
                'id'=>6,
                'name'=>'Transporte'   
            ],
            [
                'id'=>7,
                'name'=>'Facturas'   
            ],
            [
                'id'=>8,
                'name'=>'Mascotas'   
            ],
            [
                'id'=>9,
                'name'=>'Ropa y calzado'   
            ],
            [
                'id'=>10,
                'name'=>'Otros'
            ],
        ]);
    }
}
