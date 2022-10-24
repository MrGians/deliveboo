@if ($product->exists)
<form id="submit-form-edit" class="product-form" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" method="POST" novalidate>
    @method('PUT')
@else
<form class="product-form" action="{{ route('admin.products.store', $product) }}" enctype="multipart/form-data" method="POST" novalidate> 
@endif
    @csrf
    <div class="row">
        {{-- Name --}}
        <div class="col-12">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                <span id="name-error-box" class="invalid-feedback {{ $errors->has('name') ? '' : 'd-none' }}" role="alert">
                    <strong id="name-error-msg"> @error('name') {{ $message }} @enderror </strong>
                </span>
            </div>
        </div>
        {{-- Description --}}
        <div class="col-12">
            <div class="form-group">
                <label for="description">Descrizione</label>
                <textarea class="form-control  @error('description') is-invalid @enderror" id="description" name="description" required>{{ old('description', $product->description) }}</textarea>
                <span id="description-error-box" class="invalid-feedback {{ $errors->has('description') ? '' : 'd-none' }}" role="alert">
                    <strong id="description-error-msg"> @error('description') {{ $message }} @enderror </strong>
                </span>
            </div>
        </div>
        {{-- Price --}}
        <div class="col-12">
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" min="0.01" max="999.99" class="form-control  @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $product->price) }}" required>
                <span id="price-error-box" class="invalid-feedback {{ $errors->has('price') ? '' : 'd-none' }}" role="alert">
                    <strong id="price-error-msg"> @error('price') {{ $message }} @enderror </strong>
                </span>
            </div>
        </div>
        {{-- Image --}}
        <div class="col-11">
            <div class="form-group">
                <label for="image">Immagine</label>
                <input type="file" class="@error('image') is-invalid @enderror" id="image" name="image" required>
                <span id="image-error-box" class="invalid-feedback {{ $errors->has('image') ? '' : 'd-none' }}" role="alert">
                    <strong id="image-error-msg"> @error('image') {{ $message }} @enderror </strong>
                </span>
            </div>
        </div>
        {{-- image-preview --}}
        <div class="col-1">
            <img src="{{ $product->image ? asset('storage/'.$product->image) : asset('storage/products_image/placeholder.png') }}" 
                alt="{{ $product->name }}" class="img-fluid" id="thumb">
        </div>
        {{-- is_visible --}}
        <div class="col-12">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="is_visible" name="is_visible" value="1" @if(old('is_visible')) checked @endif >
                <label class="form-check-label" for="is_visible">Visualizza nel menù</label>
            </div> 
        </div>
    </div>
    <hr>
    <footer class="d-flex justify-content-between">
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-rotate-left mr-2"></i> Indietro
        </a>

        <button class="btn btn-success" type="submit">
            <i class="fa-solid fa-floppy-disk mr-2"></i> Salva
        </button>
    </footer>
</form>