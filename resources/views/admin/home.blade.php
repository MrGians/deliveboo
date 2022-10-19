@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>

        {{-- Restaurant Info --}}
        <div class="col-md-8 my-3">
            <div class="card">
                <div class="card-header"> Profilo </div>

                <div class="card-body">
                    <p class="card-text d-flex">
                        <span><strong>Username: </strong>{{ $current_user->name }}</span>
                        <span class="ml-5"><strong>Email: </strong>{{ $current_user->email }}</span>
                    </p>
                </div>
                <div class="card-header border-top"> Informazioni Ristorante </div>
                <div class="card-body">
                    <p class="card-text d-flex">
                        <span><strong>P.IVA: </strong>{{ $current_user->restaurant->p_iva }}</span>
                        <span class="ml-5"><strong>Restaurant: </strong>{{ $current_user->restaurant->name }}</span>
                        <span class="ml-5"><strong>Address: </strong>{{ $current_user->restaurant->address }}</span>
                    </p>
                    <p class="card-text d-flex">
                        <span><strong>Categories: </strong> 
                            @foreach ($current_user->restaurant->categories as $category) <span>{{ $category->label }}</span> @endforeach
                        </span>
                    </p>
                </div>
            </div>
        {{-- Delete Restaurant --}}
            <form action="{{ route('admin.restaurants.destroy', ['restaurant' => $current_user->restaurant]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Cancella definitivamente il tuo ristorante</button>
            </form>
        </div>
    </div>
</div>
@endsection
