@extends('layouts.app');

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
@endsection

@section('hero')
<div class="hero-categorias">
    <form class="container h-100" action={{ route('search.show') }}>
        <div class="row h-100 align-items-center">
            <div class="col-md-4 texto-buscar">
                <p class="display-4">Find your recipe</p>
                <input
                    type="search"
                    name="search"
                    class="form-control"
                    placeholder="Buscar Receta"
                />
            </div>
        </div>
    </form>
</div>
@endsection

@section('content')
    
    <div class="container nuevas-recetas">
        <h2 class="titulo-categoria text-uppercase mb-4">Last Recipes</h2>

        <div class="owl-carousel owl-theme">
        @foreach ($news as $new)
        
                <div class="card ">
                    <img src="{{asset('storage/'.$new->imagen) }}" class="card-img-top" alt="imagen receta">

                    <div class="card-body h-100">
                        <h3>{{ Str::title( $new->title ) }}</h3>

                        <p> {{ Str::words(  strip_tags( $new->preparation ), 15 ) }} </p>

                        <a href=" {{ route('recipes.show', ['recipe' => $new->id ]) }} "
                            class="btn btn-primary d-block font-weight-bold text-uppercase"
                        >See Recipe</a>
                    </div>
                </div>
    
        @endforeach
        </div>

    </div>
    <div class="container">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4">Most voted recipes</h2>    
        <div class="row">    
                @foreach($votes as $recipe)
                    @include('ui.recipe')
                @endforeach
        </div>
    </div>



    @foreach($recipes as $key => $group)
    <div class="container">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4"> {{ str_replace('-', ' ',  $key) }}</h2>
        
        <div class="row">
            @foreach($group as $recipes)
                @foreach($recipes as $recipe)
                    @include('ui.recipe')
                @endforeach
            @endforeach
        </div>
    </div>
    @endforeach



@endsection