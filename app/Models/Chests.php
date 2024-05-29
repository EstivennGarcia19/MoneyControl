<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chests extends Model
{
    use HasFactory;



    protected $fillable = [
        'name',
        'amount',
        'date',
        'color',
        'user_id'
    ];
}
