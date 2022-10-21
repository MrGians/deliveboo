@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card rounded-5 mt-5 pb-5 shadow">
                <div class="text-center pt-5">
                    <h3 class="font-weight-bold">Accedi</h3>
                </div>

                <div class="card-body ">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-6 offset-md-3 col-form-label">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6 offset-md-3">
                                <input placeholder="Inserisci la tua e-mail" id="email" type="email" class="shadow form-control rounded-pill mb-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <label for="password" class="col-md-6 offset-md-3 col-form-label">{{ __('Password') }}</label>

                            <div class="col-md-6 offset-md-3">
                                <input placeholder="Inserisci la tua password" id="password" type="password" class="shadow form-control rounded-pill @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3 p-0">
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Password dimenticata?
                                </a>
                                @endif
                            </div>  
                            <div class="col-md-6 offset-md-3">
                                <div class="form-check">
                                    <input class="form-check-input shadow" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mx-auto text-center">
                                <button type="submit" class="btn btn-primary w-50 rounded-pill">
                                    Accedi
                                </button>
                            </div>
                        </div> 
                        <div class="col-md-6 mx-auto text-center">
                            <div class="left-and-right-line text-center pb-2">
                                <hr>
                                <h6>Sei un ristoratore?</h6>
                                <hr>
                            </div>
                        </div> 
                        <div class="form-group row mb-0">
                            <div class="col-md-6 mx-auto text-center">
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
