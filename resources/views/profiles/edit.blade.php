@extends('layouts.app');

@section('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" integrity="sha512-494Ejp/5WyoRNfh+nPLhSCQPHhcsbA5PoIGv2/FuEo+QLfW+L7JQGPdh8Qy2ZOmkF27pyYlALrxteMiKau1tyw==" crossorigin="anonymous" />

@endsection

@section('botton')

<a href="{{route('recipes.index')}}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold"> <svg class="icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd"></path></svg> Back </a>

@endsection

@section('content')
     
<h2 class="text-center">Edit Profile</h2>
  

  <div class="row justify-content-center mt-5">
    <div class="col-md-10 bg-white p-3">
        <form method="POST" action="{{route('profiles.update',['profile'=>$profile->id])}}" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name"> Name</label>

                <input type="text"
                 name="name"
                 class="form-control @error('name') is-invalid @enderror"
                 id="name"
                 placeholder="Your Name"
                 value="{{ $profile->user->name }}"
                />

                @error('name')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="url"> Web Site</label>

                <input type="text"
                 name="url"
                 class="form-control @error('url') is-invalid @enderror"
                 id="url"
                 placeholder="Your WebSite"
                 value="{{$profile->user->url}}"
                />

                @error('url')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="biography">Biography</label>
                <input id="biography" type="hidden" name="biography"
                value="{{$profile->biography}}"> 
                <trix-editor 
                class="trix-content @error('biography') is-invalid @enderror"
                input="biography">
                </trix-editor>

                @error('biography')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="imagen"> Your Imagen </label>
                <input 
                    id="imagen" 
                    type="file"
                    class="form-control @error('imagen') is-invalid @enderror"
                    name="imagen"
                >
                @if($profile->imagen)
                    <div class="mt-4">
                        <p>Actual Imagen</p>               
                            <img src="{{asset('storage/'.$profile->imagen) }}" style="width: 300px">
                    </div>

                    @error('imagen')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                    </span>
                    @enderror
              
                @endif

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