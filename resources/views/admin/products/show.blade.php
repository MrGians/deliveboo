@extends('layouts.app')

@section('content')
  <h1 class="mb-4">{{ $product->name }}</h1>
  <hr/>
  <div class="card overflow-hidden mb-3">
    <div class="row no-gutters">
      <div class="col-md-4 bg-warning">
        @if($product->image)
        <img class="img-fluid" src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
        @else
        <img class="img-fluid" src="{{ asset('storage/products_img/placeholder.png') }}" alt="Placeholder">
        @endif
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h3 class="card-title">{{ $product->name }}</h3>
          <p class="card-text">{{ $product->description }}</p>
          <p class="card-text"><small class="text-muted">Creato il: {{ $product->created_at }}</small></p>
          <p class="card-text"><small class="text-muted">Ultima Modifica: {{ $product->updated_at }}</small></p>
          <p class="card-text"><strong>Prezzo: </strong><em>&euro;{{ $product->price }}</em></p>
          <p class="card-text">
            <strong>Stato: </strong>
            <strong class="text-{{ $product->is_visible ? 'success' : 'danger' }}">{{ $product->is_visible ? 'Pubblicato' : 'Non Pubblicato' }}</strong>
          </p>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card-footer d-flex align-items-center justify-content-between">
          <a class="btn btn-secondary ml-2" href="{{ route('admin.products.index') }}">
            <i class="fa-solid fa-arrow-rotate-left"></i> Indietro
          </a>

          <div class="d-flex">
            <a class="btn btn-warning ml-2" href="{{ route('admin.products.edit', $product) }}">
              <i class="fa-solid fa-pen-to-square"></i> Modifica
            </a>
            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="delete-form delete-product ml-2">
              @method('DELETE')
              @csrf
              <button class="btn btn-danger btn-outline" type="submit">
                <i class="fa-solid fa-trash-can"></i> Elimina
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection