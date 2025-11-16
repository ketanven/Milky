@extends('Admin.layout.app')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid py-4">
        <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary mb-3">← Back</a>

        <div class="card">
            <div class="card-header">
                <h4>Message Details</h4>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $message->name }}</p>
                <p><strong>Email:</strong> {{ $message->email }}</p>
                <p><strong>Subject:</strong> {{ $message->subject }}</p>
                <p><strong>Message:</strong></p>
                <p>{{ $message->message }}</p>
                <p class="text-muted"><small>Received at: {{ $message->created_at->format('d M Y, h:i A') }}</small></p>
            </div>
        </div>
    </div>
</div>
@endsection
