@extends('Admin.layout.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Categories</h3>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">
                <i class="fas fa-plus"></i> Add New Category
            </button>
        </div>
        @if(session('success'))
            <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-striped mb-0 align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                               
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        @if($category->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $category->created_at->format('d M, Y') }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-warning editCategoryBtn" data-toggle="modal"
                                            data-target="#editCategoryModal"
                                            data-category="{{ htmlspecialchars(json_encode($category), ENT_QUOTES, 'UTF-8') }}">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <form action="{{ route('admin.categories.toggle', $category->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                                {{ $category->is_active ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this category?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="text-center py-3">No categories found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </section>
</div>

{{-- ======================= ADD CATEGORY MODAL ======================= --}}
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Add New Category</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group"><label>Name</label><input type="text" name="name" class="form-control" required></div>
                <div class="form-group"><label>Description</label><textarea name="description" class="form-control"></textarea></div>
                <div class="form-group"><label>Image</label><input type="file" name="image" class="form-control-file"></div>
                <div class="form-check"><input type="checkbox" name="is_active" class="form-check-input" id="isActive"><label class="form-check-label" for="isActive">Active</label></div>
            </div>
            <div class="modal-footer"><button type="submit" class="btn btn-success">Save</button></div>
        </form>
    </div>
</div>

{{-- ======================= EDIT CATEGORY MODAL ======================= --}}
<div class="modal fade" id="editCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" class="modal-content" id="editCategoryForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-header bg-warning">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group"><label>Name</label><input type="text" name="name" id="editName" class="form-control" required></div>
                <div class="form-group"><label>Description</label><textarea name="description" id="editDesc" class="form-control"></textarea></div>
                <div class="form-group"><label>Replace Image</label><input type="file" name="image" class="form-control-file"></div>
                <div class="form-check"><input type="checkbox" name="is_active" id="editStatus" value="1" class="form-check-input"><label class="form-check-label" for="editStatus">Active</label></div>
            </div>
            <div class="modal-footer"><button type="submit" class="btn btn-success">Update</button></div>
        </form>
    </div>
</div>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

{{-- JS --}}
<script>
$(function () {
    $('.editCategoryBtn').click(function () {
        const category = $(this).data('category');
        $('#editCategoryForm').attr('action', `/admin-panel/categories/${category.id}`);
        $('#editName').val(category.name);
        $('#editDesc').val(category.description);
        $('#editStatus').prop('checked', category.is_active == 1);
    });
});
</script>
@endsection
