@extends('layouts.app')

@section('content')
<header class="d-flex justify-content-between align-items-center mb-3">
    <h1>Lista Ordini</h1>
    <a href="#" class="btn btn-success">
        <i class="fa-solid fa-chart-pie"></i> Vai alle statistiche
    </a>
</header>
<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Cliente</th>
            <th scope="col">Indirizzo</th>
            <th scope="col">Status</th>
            <th scope="col">Creato</th>
            <th scope="col">Modificato</th>
            <th scope="col" class="text-center">Azioni</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($orders as $i => $order)
        <tr>
            <th scope="row">{{ count($orders) - $i }}</th>
            <td>{{ $order->full_name }}</td>
            <td>{{ $order->address }}</td>
            <td><span class="btn btn-outline-{{ $order->status == 'Completato' ? 'success' : 'danger' }}">{{ $order->status }}</span></td>
            <td>{{ $order->created_at }}</td>
            <td>{{ $order->updated_at }}</td>
            <td class="d-flex justify-content-center">
                <a class="btn btn-sm btn-light mr-2" href="{{ route('admin.orders.show', $order) }}">
                    <i class="fa-solid fa-eye"></i>
                </a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7">
                <h3 class="text-center">Non sono presenti Ordini</h3>
            </td>
        </tr>  
        @endforelse 
    </tbody>
</table>
@endsection