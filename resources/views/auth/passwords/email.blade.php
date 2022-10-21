@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card rounded-5 mt-5 pb-5 shadow">
                <div class="text-center pt-5">
                    <h3 class="font-weight-bold">Reset password</h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row mb-4">
                            <label for="email" class="col-md-6 offset-md-3 col-form-label">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6 offset-md-3">
                                <input id="email" type="email" class="form-control shadow @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email address">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 mx-auto text-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Password Reset') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
