@extends('layout.app')
@section('content')

<!-- Login Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="section-title bg-white text-center text-primary px-3">Login</p>
            <h1 class="mb-5">Welcome Back to Milkly</h1>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">

                <!-- Display Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Success Message -->
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf
                    <div class="row g-3">

                        <div class="col-12">
                            <div class="form-floating">
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Your Email" value="{{ old('email') }}" required>
                                <label for="email">Email Address</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Password" required>
                                <label for="password">Password</label>
                            </div>
                        </div>

                        <div class="col-12 text-end">
                            <a href="#" class="small text-secondary">Forgot Password?</a>
                        </div>

                        <div class="col-12 text-center">
                            <button class="btn btn-secondary rounded-pill py-3 px-5" type="submit">Login</button>
                        </div>

                        <div class="col-12 text-center">
                            <p class="mt-3">Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Login End -->

@endsection
