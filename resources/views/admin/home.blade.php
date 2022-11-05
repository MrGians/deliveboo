@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Bentornato nella tua area di amministrazione!') }}
                </div>
            </div>
        </div>

        {{-- Profile Info --}}
        <div class="col-md-8 my-3">
            <div class="card">
                <div class="card-header bg-success text-white"> Profilo </div>
                <div class="card-body">
                    <p class="card-text d-flex">
                        <span><strong>Username: </strong>{{ $current_user->name }}</span>
                        <span class="ml-5"><strong>Email: </strong>{{ $current_user->email }}</span>
                    </p>
                </div>
                
            </div>
        </div>
        {{-- Restaurant Info --}}
        <div class="col-md-8 my-3">
            <div class="card">
                <div class="card-header bg-success text-white border-top"> Informazioni Ristorante </div>
                <div class="card-body">
                    <p class="card-text d-flex">
                        <span><strong>P.IVA: </strong>{{ $current_user->restaurant->p_iva }}</span>
                        <span class="ml-5"><strong>Restaurant: </strong>{{ $current_user->restaurant->name }}</span>
                        <span class="ml-5"><strong>Address: </strong>{{ $current_user->restaurant->address }}</span>
                    </p>
                    <p class="card-text d-flex">
                        <span><strong>Categories: </strong> 
                            @foreach ($current_user->restaurant->categories as $category) <span>{{ $category->label }}</span>@if ($loop->last).
                                
                            @else, @endif @endforeach
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
