@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Edytuj kategorię</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="name" class="form-label">Nazwa kategorii</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Treść</label>
                <script>
                    tinymce.init({
                        selector: 'textarea',
                        plugins: [
                        // Core editing features
                        'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
                        // Your account includes a free trial of TinyMCE premium features
                        // Try the most popular premium features until Jan 18, 2025:
                        'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown','importword', 'exportword', 'exportpdf'
                        ],
                        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                        tinycomments_mode: 'embedded',
                        tinycomments_author: 'Author name',
                        mergetags_list: [
                        { value: 'First.Name', title: 'First Name' },
                        { value: 'Email', title: 'Email' },
                        ],
                        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
                    });
                </script>
                <textarea class="form-control" id="content" name="content" rows="10">{{ $category->content }}</textarea>
            </div>

            <div class="mb-3">
                <label for="parent_id" class="form-label">Kategoria nadrzędna</label>
                <select class="form-control" id="parent_id" name="parent_id">
                    <option value="">Brak</option>
                    @foreach($categories as $cat)
                        @if($cat->id !== $category->id)
                            <option value="{{ $cat->id }}" {{ $category->parent_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
            <a href="{{ route('categories.show', $category) }}" class="btn btn-secondary">Anuluj</a>
        </form>
    </div>
</div>
@endsection