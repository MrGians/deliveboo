{{-- Alert --}}
@if (session('message'))
    <div class="alert alert-{{ session('type') ?? info }} alert-dismissible fade show">
      <strong>{{ session('message') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
@endif