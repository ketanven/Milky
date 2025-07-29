@extends('layout.app')
@section('content')

<!-- Register Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="section-title bg-white text-center text-primary px-3">Register</p>
            <h1 class="mb-5">Create Your Milkly Account</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name" placeholder="Your Name">
                                <label for="name">Full Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" placeholder="Your Email">
                                <label for="email">Email Address</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="phone" placeholder="Phone Number">
                                <label for="phone">Phone Number</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="password" class="form-control" id="password" placeholder="Password">
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="password" class="form-control" id="confirm-password" placeholder="Confirm Password">
                                <label for="confirm-password">Confirm Password</label>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-secondary rounded-pill py-3 px-5" type="submit">Register</button>
                        </div>
                        <div class="col-12 text-center">
                            <p class="mt-3">Already have an account? <a href="#">Login here</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Register End -->

@endsection
