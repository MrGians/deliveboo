@if ($product->exists)
<form action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" method="POST">
    @method('PUT')
@else
<form action="{{ route('admin.products.store', $product) }}" enctype="multipart/form-data" method="POST"> 
@endif
    @csrf
    <div class="row">
        {{-- Name --}}
        <div class="col-12">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        {{-- Description --}}
        <div class="col-12">
            <div class="form-group">
                <label for="description">Descrizione</label>
                <textarea class="form-control  @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        {{-- Price --}}
        <div class="col-12">
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" class="form-control  @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $product->price) }}">
                @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        {{-- Image --}}
        <div class="col-11">
            <div class="form-group">
                <label for="image">Immagine</label>
                <input type="file" class="@error('image') is-invalid @enderror" id="image-field" name="image">
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        {{-- image-preview --}}
        <div class="col-1">
            <img src="{{ asset('storage/'.$product->image) }}" 
                alt="{{ $product->name }}" class="img-fluid" id="preview">
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