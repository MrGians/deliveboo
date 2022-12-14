@extends('layouts.app')

@section('content')
<header class="d-flex justify-content-between align-items-center mb-3">
    <h1>Lista Prodotti</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-success">
        <i class="fa-solid fa-plus"></i> Crea nuovo Prodotto
    </a>
</header>
<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Is visible</th>
            <th scope="col">Creato</th>
            <th scope="col">Modificato</th>
            <th scope="col" class="text-center">Azioni</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($products as $i => $product)
        <tr>
            <th scope="row">{{ $i+1 }}</th>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}&euro;</td>
            <td class="align-middle">
                <form action="{{ route('admin.products.isVisible', $product) }}" method="POST">
                  @method('PATCH')
                  @csrf
                  <button class="btn btn-outline">
                    <i class="fa-2x fa-solid fa-toggle-{{ $product->is_visible ? 'on' : 'off' }} text-{{ $product->is_visible ? 'success' : 'danger' }}"></i>
                  </button>
                </form>
              </td>
            <td>{{ $product->created_at }}</td>
            <td>{{ $product->updated_at }}</td>
            <td class="d-flex justify-content-center">
                <a class="btn btn-sm btn-light mr-2" href="{{ route('admin.products.show', $product) }}">
                    <i class="fa-solid fa-eye"></i>
                </a>
                <a class="btn btn-sm btn-warning mr-2" href="{{ route('admin.products.edit', $product) }}">
                    <i class="fa-solid fa-pencil"></i>
                </a>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="delete-form delete-product">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8">
                <h3 class="text-center">Nessun product</h3>
            </td>
        </tr>  
        @endforelse 
        {{-- Delete Modal --}}
        <div id="myModal" class="modal">
            {{-- Modal content --}}
            <div class="modal-content">
                <p></p>
                <div class="btn-box">
                    <button id="delete-confirm" class="btn btn-success">Si</button>
                    <button id="delete-go-back" class="btn btn-danger">No</button>
                </div>
            </div>
        </div>
    </tbody>
</table>
@endsection