@extends('layouts.app')

@section('content')
<div class="card bg-dark text-white text-center">
  <div class="card-header">
    <span>Ordine N° {{ $order->id }}</span><span>| Status: {{ $order->status }}</span>
  </div>
  <div class="card-body">
    <h6 class="card-title">Cliente: {{ $order->full_name }}</h6>
    <h6 class="card-title">Email: {{ $order->email }}</h6>
    <h6 class="card-title">Indirizzo: {{ $order->address }}</h6>
    <h6 class="card-title">Telefono: {{ $order->tel }}</h6>
    <h6 class="card-title">Totale: {{ $order->amount }} €</h6>
    {{-- Order Products --}}
    <ul class="list-group">
      @forelse ($order->products as $product)
      <li class="list-group-item border-dark text-dark d-flex justify-content-between align-items-center">
        {{ $product->name }}
        <span class="badge badge-success badge-pill">x{{ $product->pivot->quantity }}</span>
      </li>
      @empty
          <li>Nessun Prodotto presente nell'ordine</li>
      @endforelse
    </ul>
    {{-- Actions --}}
    <a class="btn btn-secondary ml-2 my-2" href="{{ route('admin.orders.index') }}">
      <i class="fa-solid fa-arrow-rotate-left"></i> Indietro
    </a>
  </div>
  <div class="card-footer text-muted">
    Ordine in data: {{ $order->created_at }}
  </div>
</div>
@endsection