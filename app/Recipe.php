<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    // 
    protected $fillable = [
        'title', 'ingredients', 'preparation', 'imagen', 'category_id'
    ];

    public function category(){
        return $this->belongsTo(CategoryRecipe::class);
    }


    // Require the info form FK
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id'); // fk of this table
    }

    //Likes that recive each recipe

    public function likes(){
        return $this->belongsToMany(User::class, 'likes_recipe');
   
    }
}
