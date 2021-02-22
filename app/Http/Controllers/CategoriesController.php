<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\CategoryRecipe;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show(CategoryRecipe $categoryRecipe){
       $recipes = Recipe::where('category_id', $categoryRecipe->id )->paginate(2);
       return view('categories.show',compact('recipes','categoryRecipe'));
    }
}
