@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card rounded-5 mt-5 pb-5 shadow">
                <div class="text-center pt-5">
                    <h3 class="font-weight-bold">Registrati</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" novalidate>
                        @csrf
                        {{-- Name --}}
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <input id="name" type="text" class="mb-3 shadow form-control rounded-pill @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- Email --}}
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <input id="email" type="email" class="mb-3 shadow form-control rounded-pill @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email"> 

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- Restaurant Name --}}
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <input id="restaurant_name" type="text" class="mb-3 shadow form-control rounded-pill @error('restaurant_name') is-invalid @enderror" name="restaurant_name" value="{{ old('restaurant_name') }}" required placeholder="Nome Ristorante"> 

                                @error('restaurant_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- Restaurant Description --}}
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <textarea id="restaurant_description" class="mb-3 shadow form-control rounded-pill @error('restaurant_description') is-invalid @enderror" name="restaurant_description" required placeholder="Descrizione ristorante">{{ old('restaurant_description') }}</textarea>

                                @error('restaurant_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Category --}}
                        <div class="form-group row">
                            {{-- Nuovo --}}
                            <div class="col-md-6 offset-md-3">
                                <div class="accordion mb-3 @if(!old('categories') && $errors->any()) is-invalid @endif" id="accordionExample">
                                    <div class="card shadow rounded-5">
                                      <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                          <button class="shadow-none btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Seleziona categorie
                                          </button>
                                        </h2>
                                      </div>
                                  
                                      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">
                                            @forelse ($categories as $category)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="category-{{ $category->label }}" value="{{ $category->id }}" name="categories[]" @if(in_array($category->id, old('categories', []))) checked @endif>
                                                    <label class="form-check-label" for="category-{{ $category->label }}">{{ $category->label }}</label>
                                                </div>
                                            @empty 
                                          @endforelse
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                @if (!old('categories') && $errors->any())
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Devi selezionare almeno una categoria per il tuo ristorante</strong>
                                    </span> 
                                @endif
                            </div>
                        </div>
                        {{-- Restaurant Logo --}}
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <input id="restaurant_logo" type="file" class="mb-3 @error('restaurant_logo') is-invalid @enderror" name="restaurant_logo" required>

                                @error('restaurant_logo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- Restaurant Address --}}
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <input id="restaurant_address" type="text" class="mb-3 shadow form-control rounded-pill @error('restaurant_address') is-invalid @enderror" name="restaurant_address" value="{{ old('restaurant_address') }}" required placeholder="Indirizzo ristorante">

                                @error('restaurant_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- Restaurant P.IVA --}}
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <input id="p_iva" type="text" class="mb-3 shadow form-control rounded-pill @error('p_iva') is-invalid @enderror" name="p_iva" value="{{ old('p_iva') }}" maxlength="11" required placeholder="Partita IVA">

                                @error('p_iva')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- Password --}}
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <input id="password" type="password" class="mb-3 shadow form-control rounded-pill @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- Confirm Password --}}
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <input id="password-confirm" type="password" class="mb-3 shadow form-control rounded-pill" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password"> 
                            </div>
                        </div>

                        {{-- Register button --}}
                        <div class="form-group row">
                            <div class="col-md-6 mx-auto text-center">
                                <button type="submit" class="btn btn-primary w-50 rounded-pill">
                                    Registrati
                                </button>
                            </div>
                        </div> 
                        <div class="col-md-6 mx-auto text-center">
                            <div class="left-and-right-line text-center pb-2">
                                <hr>
                                <h6>Hai già un'account?</h6>
                                <hr>
                            </div>
                        </div> 
                        <div class="form-group row mb-0">
                            <div class="col-md-6 mx-auto text-center">
                                <a class=" btn btn-primary w-50 rounded-pill" href="{{ route('login') }}">Accedi</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
