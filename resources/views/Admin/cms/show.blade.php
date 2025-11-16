@extends('layout.app')

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <h1 class="mb-4">{{ $page->title }}</h1>
        <div class="border p-4 rounded shadow-sm">
            {!! $page->content !!}
        </div>
    </div>
</div>
@endsection
