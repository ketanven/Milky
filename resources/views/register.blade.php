@extends('layout.app')
@section('content')

    @if(auth('user')->check())
        <script>window.location = "{{ route('home') }}";</script>
    @endif



    <!-- Register Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="section-title bg-white text-center text-primary px-3">Register</p>
                <h1 class="mb-4">Create Your Milkly Account</h1>
                <p class="text-muted">Join Milkly to enjoy fresh dairy, subscriptions, rewards, and more.</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.2s">
                    <form method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data">
                        @csrf


                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row g-3">

                            <!-- Full Name -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Full Name"
                                        required>
                                    <label for="name">Full Name</label>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="Email Address" required>
                                    <label for="email">Email Address</label>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="phone" class="form-control" id="phone"
                                        placeholder="Phone Number" required>
                                    <label for="phone">Phone Number</label>
                                </div>
                            </div>

                            <!-- DOB -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" name="dob" class="form-control" id="dob" placeholder="Date of Birth">
                                    <label for="dob">Date of Birth</label>
                                </div>
                            </div>

                            <!-- Gender -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="gender" name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <label for="gender">Gender</label>
                                </div>
                            </div>

                            <!-- Profile Image -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="file" name="profile_image" class="form-control" id="profile_image">
                                    <label for="profile_image">Profile Picture</label>
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" name="address_line" class="form-control" id="address_line"
                                        placeholder="Street Address">
                                    <label for="address_line">Street Address</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" name="city" class="form-control" id="city" placeholder="City">
                                    <label for="city">City</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" name="state" class="form-control" id="state" placeholder="State">
                                    <label for="state">State</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" name="pin_code" class="form-control" id="pin_code"
                                        placeholder="PIN Code">
                                    <label for="pin_code">PIN Code</label>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" name="password" class="form-control" id="password"
                                        placeholder="Password" required>
                                    <label for="password">Password</label>
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" name="password_confirmation" class="form-control"
                                        id="confirm-password" placeholder="Confirm Password" required>
                                    <label for="confirm-password">Confirm Password</label>
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="col-12 text-center">
                                <button class="btn btn-secondary rounded-pill py-3 px-5" type="submit">Register</button>
                            </div>

                            <!-- Login Link -->
                            <div class="col-12 text-center">
                                <p class="mt-3">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Register End -->

@endsection