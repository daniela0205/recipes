@extends('layouts.app');

@section('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" integrity="sha512-494Ejp/5WyoRNfh+nPLhSCQPHhcsbA5PoIGv2/FuEo+QLfW+L7JQGPdh8Qy2ZOmkF27pyYlALrxteMiKau1tyw==" crossorigin="anonymous" />

@endsection

@section('botton')

<a href="{{route('recipes.index')}}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold"> <svg class="icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd"></path></svg> Back </a>

@endsection

@section('content')


<h2 class="text-center mb-5"> Create  Recipe</h2>
  
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form method="POST" action="{{route('recipes.store')}}" enctype="multipart/form-data" novalidate>
                @csrf 
                <div class="form-group">
                    <label for="title"> Reciple Title</label>

                    <input type="text"
                     name="title"
                     class="form-control @error('title') is-invalid @enderror"
                     id="title"
                     placeholder="Recips Title"
                     value="{{old('title')}}"
                    />

                    @error('title')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category"> Category</label>
                    <select
                        name="category"
                        class="form-control @error('category') is-invalid @enderror"
                        id="category"
                        >
                        <option value="">--Seleccion--</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                             {{ old('category') == $category->id ? 'selected' : ''}}
                             > {{$category->name}}</option>
                        @endforeach
                    
                    </select>
                      @error('category')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                        </span>
                       @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="preparation"> Preparation </label>
                    <input id="preparation" type="hidden" name="preparation"
                   value={{old('preparation')}}  > 

                   <trix-editor 
                   class="trix-content @error('ingredient') is-invalid @enderror"
                   input="preparation">
                   </trix-editor>
                 
                   @error('preparation')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                    </span>
                  @enderror

                </div>

                
                <div class="form-group mt-3">
                    <label for="ingredient"> Ingredients </label>
                    <input id="ingredient" type="hidden" name="ingredient"
                   value={{ old('ingredient') }} > 
                   <trix-editor
                   class="trix-content @error('ingredient') is-invalid @enderror"     
                   input="ingredient"> 
                    </trix-editor>
                  
                   @error('ingredient')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                    </span>
                  @enderror
                </div>

                 
                <div class="form-group mt-3">
                    <label for="imagen"> Imagen </label>
                    <input 
                        id="imagen" 
                        type="file"
                        class="form-control @error('imagen') is-invalid @enderror"
                        name="imagen"
                    >

                    @error('imagen')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                    </span>
                  @enderror
                </div>

                <div class="form-group">
                    <input type="submit" class="btn-primary" value="Accept"/>
                </div>
            </form>
        </div>
    </div>
   

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js" integrity="sha512-wEfICgx3CX6pCmTy6go+PmYVKDdi4KHhKKz5Xx/boKOZOtG7+rrm2fP7RUR2o4m/EbPdwbKWnP05dvj4uzoclA==" crossorigin="anonymous" defer></script>
@endsection