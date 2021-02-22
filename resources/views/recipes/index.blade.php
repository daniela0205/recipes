@extends('layouts.app');


@section('botton')

@include('ui.navigation')
@endsection

@section('content')


<h2 class="text-center mb-5"> Recips Manager </h2>

    <div class="col-md-10 mx-auto bg-white p-3">
        <table class="table">
            <thead class="bg-primary text-light">
                <tr>
                    <th scole="col">Title</th>
                    <th scole="col">Category</th>
                    <th scole="col">Accion</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recipes as $recipe)
                <tr>
                    <td>{{$recipe->title}}</td>
                    <td>{{$recipe->category->name}}</td>
                    <td>
                        {{-- <form action="{{ route('recipes.destroy', ['recipe'=>$recipe->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger  d-block w-100" value="Delet" >
                        </form> --}}
              
                        <delete-recipe
                            recipe-id = {{$recipe->id}}
                        >
                        </delete-recipe>
                        
                         <a href="{{ route('recipes.edit', ['recipe'=>$recipe->id]) }}" class="btn btn-dark d-block mb-2">Edith</a>
                        <a href="{{ route('recipes.show', ['recipe'=>$recipe->id]) }}" class="btn btn-success d-block mb-2">Show</a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="col-12 mt-4 justify-content-center d-flex">
            {{$recipes->links()}}
        </div>

        <h2 class="text-center my-5"> Recipe that you like</h2>
            <div class="col-md-10 mx-auto bg-white p-3">
                @if( count($user->iLiked)>0 )
                    <ul class="List-group">
                        @foreach($user->iLiked as $recipe)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                <p>{{ $recipe->title}}</p>
                                <a class="btn btn-outline-success text-uppercase font-weight-bold"href="{{route('recipes.show', ['recipe'=> $recipe->id])}}">See</a>
                            </li> 
                        @endforeach

                    </ul>
                @else
                    <p class="text-center">Not have any recipe that you like saving</p>
                @endif
                
            </div>
        
    </div>


@endsection