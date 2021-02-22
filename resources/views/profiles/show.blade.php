@extends('layouts.app');


@section('content')
  
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                @if($profile->imagen)
                <img src="{{asset('storage/'.$profile->imagen) }}" class="w-100 rounded-circle" alt="imagen chef">
                @endif
            </div>
            <div class="col-md-7 mt-5 md-0">
                <h2 class="text-center mb-2 text-primary">{{$profile->user->name}}</h2>
                <a href="{{$profile->user->url}}">Visit WebSite</a>
                <div class="biografy">
                    {!! $profile->biography !!}
                </div>
            </div>

        </div>
    </div>

    <h2 class="text-center my-5"> Recipe create by : {{$profile->user->name}} </h2>
    <div class="container">
        <div class="row mx-auto bg-white p-4">
            @if(count($recipes) > 0)
                @foreach($recipes as $recipe )
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img  src="{{asset('storage/'.$recipe->imagen)}}" class="card-img-top" alt="Recipe imagen" >
                            <div class="card-body">
                                <h3>{{$recipe->title}}
                                <a href="{{ route('recipes.show', ['recipe'=> $recipe->id] ) }}" class="btn btn-primary d-block mt-4 text-uppercase font-weight-bold " > View</a>
                            
 
                            </div>
                            
                        </div>
                    </div>
                @endforeach
            @else
             <p class="text-center w-100"> Not find any recipe ...</p>
            @endif
        </div>
        
     <div class="col-12 mt-4 justify-content-center d-flex">
        {{$recipes->links()}}
    </div>
    </div>

@endsection