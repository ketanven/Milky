@extends('Admin.layout.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Sellers</h3>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addSellerModal">
                <i class="fas fa-plus"></i> Add New Seller
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
                                <th>Store Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sellers as $seller)
                                <tr>
                                    <td>{{ $seller->id }}</td>
                                    <td>{{ $seller->name }}</td>
                                    <td>{{ $seller->store_name }}</td>
                                    <td>{{ $seller->email }}</td>
                                    <td>{{ $seller->phone ?? '-' }}</td>
                                    <td>
                                        @if($seller->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $seller->created_at->format('d M, Y') }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-warning editSellerBtn" data-toggle="modal"
                                            data-target="#editSellerModal"
                                            data-seller="{{ htmlspecialchars(json_encode($seller), ENT_QUOTES, 'UTF-8') }}">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <form action="{{ route('admin.sellers.toggle', $seller->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                                {{ $seller->is_active ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.sellers.destroy', $seller->id) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this seller?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-3">No sellers found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    {{ $sellers->links() }}
                </div>
            </div>
        </div>
    </section>
</div>

{{-- ======================= ADD SELLER MODAL ======================= --}}
<div class="modal fade" id="addSellerModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.sellers.store') }}" class="modal-content">
            @csrf
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Add New Seller</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group"><label>Name</label><input type="text" name="name" class="form-control" required></div>
                <div class="form-group"><label>Email</label><input type="email" name="email" class="form-control" required></div>
                <div class="form-group"><label>Password</label><input type="password" name="password" class="form-control" required></div>
                <div class="form-group"><label>Confirm Password</label><input type="password" name="password_confirmation" class="form-control" required></div>
                <div class="form-group"><label>Store Name</label><input type="text" name="store_name" class="form-control" required></div>
                <div class="form-group"><label>Shop Address</label><textarea name="shop_address" class="form-control"></textarea></div>
                <div class="form-group"><label>GST Number</label><input type="text" name="gst_number" class="form-control"></div>
                <div class="form-group"><label>PAN Number</label><input type="text" name="pan_number" class="form-control"></div>
                <div class="form-group"><label>Phone</label><input type="text" name="phone" class="form-control"></div>
                <div class="form-group"><label>Contact Email</label><input type="email" name="contact_email" class="form-control"></div>
                <div class="form-group"><label>Contact Phone</label><input type="text" name="contact_phone" class="form-control"></div>
                <div class="form-check"><input type="checkbox" name="is_active" class="form-check-input" id="isActive"><label class="form-check-label" for="isActive">Active</label></div>
            </div>
            <div class="modal-footer"><button type="submit" class="btn btn-success">Save</button></div>
        </form>
    </div>
</div>

{{-- ======================= EDIT SELLER MODAL ======================= --}}
<div class="modal fade" id="editSellerModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" class="modal-content" id="editSellerForm">
            @csrf
            @method('PUT')
            <div class="modal-header bg-warning">
                <h5 class="modal-title">Edit Seller</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group"><label>Name</label><input type="text" name="name" id="editName" class="form-control" required></div>
                <div class="form-group"><label>Email</label><input type="email" name="email" id="editEmail" class="form-control" required></div>
                <div class="form-group"><label>New Password (optional)</label><input type="password" name="password" class="form-control"></div>
                <div class="form-group"><label>Confirm Password</label><input type="password" name="password_confirmation" class="form-control"></div>
                <div class="form-group"><label>Store Name</label><input type="text" name="store_name" id="editStore" class="form-control" required></div>
                <div class="form-group"><label>Shop Address</label><textarea name="shop_address" id="editShop" class="form-control"></textarea></div>
                <div class="form-group"><label>GST Number</label><input type="text" name="gst_number" id="editGST" class="form-control"></div>
                <div class="form-group"><label>PAN Number</label><input type="text" name="pan_number" id="editPAN" class="form-control"></div>
                <div class="form-group"><label>Phone</label><input type="text" name="phone" id="editPhone" class="form-control"></div>
                <div class="form-group"><label>Contact Email</label><input type="email" name="contact_email" id="editCEmail" class="form-control"></div>
                <div class="form-group"><label>Contact Phone</label><input type="text" name="contact_phone" id="editCPhone" class="form-control"></div>
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
    $('.editSellerBtn').click(function () {
        const seller = $(this).data('seller');
        $('#editSellerForm').attr('action', `/admin-panel/sellers/${seller.id}`);
        $('#editName').val(seller.name);
        $('#editEmail').val(seller.email);
        $('#editStore').val(seller.store_name);
        $('#editShop').val(seller.shop_address);
        $('#editGST').val(seller.gst_number);
        $('#editPAN').val(seller.pan_number);
        $('#editPhone').val(seller.phone);
        $('#editCEmail').val(seller.contact_email);
        $('#editCPhone').val(seller.contact_phone);
        $('#editStatus').prop('checked', seller.is_active == 1);
    });
});
</script>
@endsection
