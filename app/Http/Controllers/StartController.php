<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\CategoryRecipe;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class StartController extends Controller
{
    //
    public function index()
    {
        // show recipes with more votes
        $votes = Recipe::withCount('likes')->orderBy('likes_count','desc')->take(3)->get();
        // Get the lastest recipes
        $news = Recipe::latest()->take(5)->get();
        
        //Get all categories
        $categories = CategoryRecipe::all();

    

        //Set Recipes by categories
        $recipes = [];
        foreach($categories as $category){
            $recipes[Str::slug($category->name)][]= Recipe::where('category_id', $category->id)->take(3)->get();
        }
        //return $recipes;
        
        return view('start.index',compact('news','recipes','votes'));
    }
}
