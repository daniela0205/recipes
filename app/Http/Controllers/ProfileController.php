<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\Profile;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>'show']);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        $recipes = Recipe::where('user_id', $profile->user_id)->paginate(2);
       return view('profiles.show', compact('profile', 'recipes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        $this->authorize('view',$profile);

        return view('profiles.edit',compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //Policy run

        $this->authorize('update',$profile);
        // Validate
        $data = request()->validate([
            'name' => 'required',
            'url' => 'required',
            'biography' => 'required'
            
        ]);
        // if user update imagen

        if(request('imagen')){          
            $route_imagen = $request['imagen']->store('upload-profiles','public');        
            // Resize imagen 
            $img = Image::make(public_path("storage/{$route_imagen}"))->fit(600,600);
            $img->save();

            $array_imagen = ['imagen' => $route_imagen];
            
        }

        // update name and URL
            auth()->user()->url = $data['url'];
            auth()->user()->name = $data['name'];
            auth()->user()->save();
        
        // Clean url and name in $data
            unset($data['url']);
            unset($data['name']);
        // update Biografhy 
            auth()->user()->profile()->update(array_merge(
                $data,
                $array_imagen ?? []
            ));
        
        return redirect()->action('RecipeController@index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
