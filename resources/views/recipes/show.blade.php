@extends('layouts.app')

@section('content')
    {{-- <h1>{{$recipe}}</h1> --}}
    <article class="content-recipe bg-white p-5 shadow">

        <h1 class="text-center mb-4">{{$recipe->title}}</h1>
        <div class="imagen-recipe">
            {{-- <img src="../storage/{{$recipe->imagen}}" class="w-100"> --}}
            <img src="{{asset('storage/'.$recipe->imagen) }}"  class="w-100">
                       
        </div>
        
        <div class="recipe-meta mt-3">
            <p>
                <span class="font-weight-bold text-primary"> Write in: </span>
              
                <a class="text-dark" href="{{ route('categories.show', ['categoryRecipe' => $recipe->category->id ]) }} ">
                    {{$recipe->category->name}}
                </a>

            </p>
            <p>
                {{--To do : show user name--}}
                <span class="font-weight-bold text-primary"> Author: </span>
                <a class="text-dark" href="{{ route('profiles.show', ['profile' => $recipe->author->id]) }} ">
                    {{$recipe->author->name}}
                </a>

           
            </p>
            <p>
                <span class="font-weight-bold text-primary"> Date: </span>
                @php
                $date = $recipe->created_at
                @endphp
                <date-recipe date="{{$date}}" > </date-recipe>              
            </p>

       
        <div>
            <h2 class="my-3 text-primary">Ingredients</h2>
            {!! $recipe->ingredients!!}
        </div>
        <div>
            <h2 class="my-3 text-primary">Preparation</h2>
            {!! $recipe->preparation!!}
        </div>
    
        <div class="justify-content-center row text-center row text-center">
                <like-button
            recipe-id="{{$recipe->id}}"
            like="{{$like}}"
            likes="{{$likes}}"
            > </like-button>
        </div>
   
    </div>
    </article>
@endsection