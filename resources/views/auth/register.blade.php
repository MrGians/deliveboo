@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card rounded-5 mt-5 pb-5 shadow">
                <div class="text-center pt-5">
                    <h3 class="font-weight-bold">Registrati</h3>
                </div>

                <div class="card-body">
                    <form class="register-form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data" novalidate>
                        @csrf
                        {{-- Name --}}
                        <div class="form-group row">
                            <label for="name" class="col-md-8 offset-md-2 col-form-label">{{ __('Nome') }} *</label>

                            <div class="col-md-8 offset-md-2">
                                <input id="name" type="text" class="mb-3 shadow form-control rounded-pill @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                <span id="name-error-box" class="invalid-feedback {{ $errors->has('name') ? '' : 'd-none' }}" role="alert">
                                    <strong id="name-error-msg"> @error('name') {{ $message }} @enderror </strong>
                                </span>
                            </div>
                        </div>
                        {{-- Email --}}
                        <div class="form-group row">
                            <label for="email" class="col-md-8 offset-md-2 col-form-label">{{ __('Indirizo Email') }} *</label>

                            <div class="col-md-8 offset-md-2">
                                <input id="email" type="email" class="mb-3 shadow form-control rounded-pill @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"> 
                                <span id="email-error-box" class="invalid-feedback {{ $errors->has('email') ? '' : 'd-none' }}" role="alert">
                                    <strong id="email-error-msg"> @error('email') {{ $message }} @enderror </strong>
                                </span>
                            </div>
                        </div>
                        {{-- Restaurant Name --}}
                        <div class="form-group row">
                            <label for="restaurant_name" class="col-md-8 offset-md-2 col-form-label">{{ __('Nome ristorante') }} *</label>

                            <div class="col-md-8 offset-md-2">
                                <input id="restaurant_name" type="text" class="mb-3 shadow form-control rounded-pill @error('restaurant_name') is-invalid @enderror" name="restaurant_name" value="{{ old('restaurant_name') }}" required > 
                                <span id="restaurant_name-error-box" class="invalid-feedback {{ $errors->has('restaurant_name') ? '' : 'd-none' }}" role="alert">
                                    <strong id="restaurant_name-error-msg"> @error('restaurant_name') {{ $message }} @enderror </strong>
                                </span>
                            </div>
                        </div>
                        {{-- Restaurant Description --}}
                        <div class="form-group row">
                            <label for="restaurant_description" class="col-md-8 offset-md-2 col-form-label">{{ __('Descrizione ristorante') }} *</label>

                            <div class="col-md-8 offset-md-2">
                                <textarea id="restaurant_description" class="mb-3 shadow form-control rounded-5 @error('restaurant_description') is-invalid @enderror" name="restaurant_description" required >{{ old('restaurant_description') }}</textarea>
                                <span id="restaurant_description-error-box" class="invalid-feedback {{ $errors->has('restaurant_description') ? '' : 'd-none' }}" role="alert">
                                    <strong id="restaurant_description-error-msg"> @error('restaurant_description') {{ $message }} @enderror </strong>
                                </span>
                            </div>
                        </div>
                        {{-- Category --}}
                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2">
                                <div class="accordion mb-3 @if(!old('categories') && $errors->any()) is-invalid @endif" id="accordionExample">
                                    <div class="card shadow rounded-5">
                                      <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                          <button class="shadow-none btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Seleziona categorie *
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
                                <span id="categories-error-box" class="invalid-feedback {{ $errors->has('categories') ? '' : 'd-none' }}" role="alert">
                                    <strong id="categories-error-msg"> @if (!old('categories') && $errors->any()) {{ $errors->first('categories') }} @endif </strong>
                                </span>
                            </div>
                        </div>
                        {{-- Restaurant Logo --}}
                        <div class="form-group row">
                            <label for="restaurant_logo" class="col-md-8 offset-md-2 col-form-label">{{ __('Logo ristorante') }} *</label>

                            <div class="col-md-8 offset-md-2">
                                <input id="restaurant_logo" type="file" class="mb-3 @error('restaurant_logo') is-invalid @enderror" name="restaurant_logo" required>
                                <span id="restaurant_logo-error-box" class="invalid-feedback {{ $errors->has('restaurant_logo') ? '' : 'd-none' }}" role="alert">
                                    <strong id="restaurant_logo-error-msg"> @error('restaurant_logo') {{ $message }} @enderror </strong>
                                </span>
                            </div>
                        </div>
                        {{-- Restaurant Address --}}
                        <div class="form-group row">
                            <label for="restaurant_address" class="col-md-8 offset-md-2 col-form-label">{{ __('Indirizzo ristorante') }} *</label>

                            <div class="col-md-8 offset-md-2">
                                <input id="restaurant_address" type="text" class="mb-3 shadow form-control rounded-pill @error('restaurant_address') is-invalid @enderror" name="restaurant_address" value="{{ old('restaurant_address') }}" required >
                                <span id="restaurant_address-error-box" class="invalid-feedback {{ $errors->has('restaurant_address') ? '' : 'd-none' }}" role="alert">
                                    <strong id="restaurant_address-error-msg"> @error('restaurant_address') {{ $message }} @enderror </strong>
                                </span>
                            </div>
                        </div>
                        {{-- Restaurant P.IVA --}}
                        <div class="form-group row">
                            <label for="p_iva" class="col-md-8 offset-md-2 col-form-label">{{ __('Partita IVA') }} *</label>

                            <div class="col-md-8 offset-md-2">
                                <input id="p_iva" type="text" class="mb-3 shadow form-control rounded-pill @error('p_iva') is-invalid @enderror" name="p_iva" value="{{ old('p_iva') }}" maxlength="11" required >
                                <span id="p_iva-error-box" class="invalid-feedback {{ $errors->has('p_iva') ? '' : 'd-none' }}" role="alert">
                                    <strong id="p_iva-error-msg"> @error('p_iva') {{ $message }} @enderror </strong>
                                </span>
                            </div>
                        </div>
                        {{-- Password --}}
                        <div class="form-group row">
                            <label for="password" class="col-md-8 offset-md-2 col-form-label">{{ __('Password') }} *</label>

                            <div class="col-md-8 offset-md-2">
                                <input id="password" type="password" class="mb-3 shadow form-control rounded-pill @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" >
                                <span id="password-error-box" class="invalid-feedback {{ $errors->has('password') ? '' : 'd-none' }}" role="alert">
                                    <strong id="password-error-msg"> @error('password') {{ $message }} @enderror </strong>
                                </span>
                            </div>
                        </div>
                        {{-- Confirm Password --}}
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-8 offset-md-2 col-form-label">{{ __('Conferma password') }} *</label>

                            <div class="col-md-8 offset-md-2">
                                <input id="password-confirm" type="password" class="mb-3 shadow form-control rounded-pill" name="password_confirmation" required autocomplete="new-password" > 
                            </div>
                        </div>

                        {{-- Register button --}}
                        <div class="form-group row">
                            <div class="col-md-8 mx-auto text-center">
                                <button type="submit" class="btn btn-primary w-50 rounded-pill">
                                    Registrati
                                </button>
                            </div>
                        </div> 
                        <div class="col-md-8 mx-auto text-center">
                            <div class="left-and-right-line text-center pb-2">
                                <hr>
                                <h6>Hai già un'account?</h6>
                                <hr>
                            </div>
                        </div> 
                        <div class="form-group row mb-0">
                            <div class="col-md-8 mx-auto text-center">
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
