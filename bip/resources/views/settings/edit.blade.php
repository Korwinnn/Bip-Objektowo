@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Ustawienia instytucji</h3>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="institution_name" class="form-label">Nazwa instytucji</label>
                <input type="text" 
                       class="form-control @error('institution_name') is-invalid @enderror" 
                       id="institution_name" 
                       name="institution_name" 
                       value="{{ old('institution_name', $settings['institution_name'] ?? '') }}">
                @error('institution_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="institution_logo" class="form-label">Logo instytucji</label>
                @if(isset($settings['institution_logo']))
                    <div class="mb-2">
                        <img src="{{ asset('storage/images/' . $settings['institution_logo']) }}" 
                            alt="Aktualne logo" 
                            style="max-height: 100px">
                    </div>
                @endif
                <input type="file" 
                    class="form-control @error('institution_logo') is-invalid @enderror" 
                    id="institution_logo" 
                    name="institution_logo" 
                    onchange="checkImageHeight(this)">
                @error('institution_logo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <script>
                function checkImageHeight(input) {
                    const file = input.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const img = new Image();
                            img.onload = function() {
                                if (img.height > 120) {
                                    alert("Wybrany plik ma zbyt dużą wysokość. Maksymalna wysokość to 120px.");
                                    input.value = ''; // Usuwamy wybrany plik
                                }
                            };
                            img.src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                }
            </script>
            <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
        </form>
    </div>
</div>
@endsection