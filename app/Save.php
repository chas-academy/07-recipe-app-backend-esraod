<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Save extends Model
{
    protected $fillable = [
        'recipeID',
    ];

    protected $casts = [
        'saves' => 'array',
    ];


    
}