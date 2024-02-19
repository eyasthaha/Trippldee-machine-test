<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'prep_time',
        'difficulty',
        'veg'
    ];

    public function rating(){

        return $this->hasMany(Rating::class,'recipe_id');
        
    }

}
