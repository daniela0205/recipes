<?php

namespace App\Http\Controllers;

use App\CategoryRecipe;
use App\Recipe;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecipeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => ['show','search']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // Auth::user()->recipes->dd();

       $user = auth()->user();

       $recipes= Recipe::where('user_id', $user->id)->paginate(3);
       return view('recipes.index')
                ->with('recipes',$recipes)
                ->with('user',$user);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // DB::table('category_recipe')->get()->pluck('name','id')->dd();

       // $categories = DB::table('category_recipes')->get()->pluck('name','id');


        $categories = CategoryRecipe::all(['id','name']);

        return view('recipes.create')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request['imagen']->store('upload-recetas', 'public') );


          //Validation
        $data = request()->validate([
            'title' => 'required|min:6',
            'preparation' =>'required',
            'ingredient' => 'required',
            'imagen' => 'required|image',
            'category' => 'required'
        ]);

        //imagen route

        $route_imagen = $request['imagen']->store('upload-recipes','public');



        // Resize imagen

         // Resize imagen
         $img = Image::make(public_path("storage/{$route_imagen}"))->fit(1000,550);

        // dd($img);

        $img->save();

          // save in db with model
        auth()->user()->recipes()->create([
            'title' => $data['title'],
            'ingredients' => $data['ingredient'],
            'preparation' =>$data['preparation'],
            'imagen' => $route_imagen,
            'category_id' => $data['category']
        ]);

        return redirect()->action('RecipeController@index');


        // //Validation
        // $data = request()->validate([
        //     'title' => 'required|min:6',
        //     'preparation' =>'required',
        //     'ingredient' => 'required',
        //     'imagen' => 'required|image',
        //     'category' => 'required'
        // ]);

        // //imagen route

        // $route_imagen = $request['imagen']->store('upload-recipes','public');

        // // Resize imagen
        // $img = Image::make(public_path("storage/{$route_imagen}"))->fit(1000,550);


        // $img->save();

        //   // save in db with model
        // auth()->user()->recipes()->create([
        //     'title' => $data['title'],
        //     'ingredients' => $data['ingredient'],
        //     'preparation' =>$data['preparation'],
        //     'imagen' => $route_imagen,
        //     'category_id' => $data['category']
        // ]);

        // return redirect()->action('RecipeController@index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        // have if the actual user like the recipe and it is authentificate
        $like = (auth()->user()) ? auth()->user()->iLiked->contains($recipe->id) : false;
        $likes = $recipe->likes->count();
        return view('recipes.show', compact('recipe', 'like', 'likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        // Check the policy
        $this->authorize('view', $recipe);

        $categories = CategoryRecipe::all(['id','name']);
        return view('recipes.edit', compact('categories','recipe'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
            // Check the policy
            $this->authorize('update', $recipe);

              //Validation
              $data = request()->validate([
                'title' => 'required|min:6',
                'preparation' =>'required',
                'ingredient' => 'required',
                'category' => 'required'
            ]);

            // Update value
            $recipe->title = $data['title'];
            $recipe->preparation = $data['preparation'];
            $recipe->ingredients = $data['ingredient'];
            $recipe->category_id = $data['category'];

            //Update imagen
            if(request('imagen')){
                $route_imagen = $request['imagen']->store('upload-recipes','public');
                // Resize imagen
                $img = Image::make(public_path("storage/{$route_imagen}"))->fit(1000,550);
                $img->save();

                $recipe->imagen = $route_imagen;
            }
            $recipe->save();

            return redirect()->action('RecipeController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {

         // Check the policy

         $this->authorize('delete', $recipe);

         // Delet reciped
         $recipe->delete();

         return redirect()->action('RecipeController@index');

    }

    public function search(Request $request){
       // $search = $request['search'];

        $search = $request->get('search');

        $recipes = Recipe::where('title', 'like', '%' . $search . '%')->paginate(10);
        $recipes->appends(['search' => $search]);

        return view('search.show', compact('recipes', 'search'));
    }
}
