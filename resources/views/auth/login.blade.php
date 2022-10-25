@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card rounded-5 mt-5 pb-5 shadow">
                <div class="text-center pt-5">
                    <h3 class="font-weight-bold">Accedi</h3>
                </div>

                <div class="card-body">
                    <form method="POST" id="login_form" class="login_form" action="{{ route('login') }}" novalidate>
                        @csrf

                         {{-- Email --}}
                        <div class="form-group row">
                            <label for="email" class="col-md-8 offset-md-2 col-form-label">{{ __('Indirizzo Email') }} *</label>
                            <div class="col-md-8 offset-md-2">

                                {{-- [email] server and client side registration validation --}}
                                <input id="email" type="email" class="shadow form-control rounded-pill mb-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <span id="error_email_box" class="invalid-feedback {{ $errors->has('email') ? '' : 'd-none' }}" role="alert">
                                    <strong id="error_email_msg">@error('email') {{ $message }} @enderror</strong>
                                </span>
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="form-group row mb-0">
                            <label for="password" class="col-md-8 offset-md-2 col-form-label">{{ __('Password') }} *</label>
                            <div class="col-md-8 offset-md-2">

                                {{-- [password] server and client side register validation --}}
                                <input id="password" type="password" class="shadow form-control rounded-pill @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                <span id="error_password_box" class="invalid-feedback {{ $errors->has('password') ? '' : 'd-none' }}" role="alert">
                                    <strong id="error_password_msg">@error('password') {{ $message }} @enderror</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2 p-0">
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Password dimenticata?
                                </a>
                                @endif
                            </div>  
                            <div class="col-md-8 offset-md-2">
                                <div class="form-check">
                                    <input class="form-check-input shadow" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8 mx-auto text-center">
                                <button id="log_in_submit" type="submit" class="btn btn-primary w-50 rounded-pill">
                                    Accedi
                                </button>
                            </div>
                        </div> 
                        <div class="col-md-8 mx-auto text-center">
                            <div class="left-and-right-line text-center pb-2">
                                <hr>
                                <h6>Sei un ristoratore?</h6>
                                <hr>
                            </div>
                        </div> 
                        <div class="form-group row mb-0">
                            <div class="col-md-8 mx-auto text-center">
                                <a class=" btn btn-primary w-50 rounded-pill" href="{{ route('register') }}">Registrati</a>
                            </div>
                        </div>       
                    </form>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
