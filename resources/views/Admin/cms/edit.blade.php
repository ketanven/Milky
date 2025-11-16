@extends('Admin.layout.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid mb-3">
            <h3>{{ $page->id ? 'Edit Page' : 'Create New Page' }}</h3>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.cms.update', $page->id ?? 0) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $page->title) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="is_active" class="form-label">Active</label>
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $page->is_active) ? 'checked' : '' }}>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea name="content" id="content" class="form-control" rows="10">{{ old('content', $page->content) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success">{{ $page->id ? 'Update Page' : 'Create Page' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
</script>
@endsection
