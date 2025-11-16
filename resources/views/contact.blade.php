@extends('layout.app')
@section('content')

<!-- Contact Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="section-title bg-white text-center text-primary px-3">Contact Us</p>
            <h1 class="mb-4">Get In Touch With Milkly</h1>
            <p class="text-muted">We'd love to hear from you! Fill out the form below and we'll get back to you as soon as possible.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.2s">

                {{-- ✅ Success Message --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- ✅ Validation Errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">

                        <!-- Full Name -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Full Name" required>
                                <label for="name">Full Name</label>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email Address" required>
                                <label for="email">Email Address</label>
                            </div>
                        </div>

                        <!-- Subject -->
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" name="subject" class="form-control" id="subject" placeholder="Subject" required>
                                <label for="subject">Subject</label>
                            </div>
                        </div>

                        <!-- Message -->
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" name="message" placeholder="Write your message here" id="message" style="height: 150px;" required></textarea>
                                <label for="message">Message</label>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="col-12 text-center">
                            <button class="btn btn-secondary rounded-pill py-3 px-5" type="submit">Send Message</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

@endsection
