@extends('layout.app')
@section('content')

    <!-- Product Start -->
    <div class="container-xxl py-1">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="section-title bg-white text-center text-primary px-3">Our Products</p>
                <h1 class="mb-5">Our Dairy Products For Healthy Living</h1>
            </div>
            <div class="row gx-4">
                @foreach($products as $index => $product)
                    <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="{{ 0.1 + ($index * 0.2) }}s">
                        <div class="product-item">
                            <div class="position-relative">
                                <img class="img-fluid" style="object-fit: cover;height: 300px"
                                    src="{{ asset('assets/img/product/' . $product->image) }}" alt="{{ $product->name }}">
                                <div class="product-overlay">
                                    <button class="btn btn-square btn-secondary rounded-circle m-1 add-to-cart"
                                        data-url="{{ route('add.to.cart', $product->id) }}">
                                        <i class="bi bi-cart"></i>
                                    </button>

                                    <button class="btn btn-square btn-secondary rounded-circle m-1 add-to-wishlist"
                                        data-url="{{ route('add.to.wishlist', $product->id) }}">
                                        <i class="bi bi-heart"></i>
                                    </button>

                                </div>

                            </div>
                            <div class="text-center p-4">
                                <a class="d-block h5" href="">{{ $product->name }}</a>
                                <span class="text-primary me-1">₹{{ number_format($product->price, 2) }}</span>
                                {{-- Optional: show old price --}}
                                {{-- <span class="text-decoration-line-through">$29.00</span> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Product End -->



    <!-- Features Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="section-title bg-white text-start text-primary pe-3">Why Choose Us</p>
                    <h1 class="mb-4">What Makes Our Dairy Trusted by Families</h1>
                    <p class="mb-4">For generations, we have been committed to delivering milk and dairy products that are
                        fresh, pure, and full of nutrition. From careful cattle care to hygienic processing and doorstep
                        delivery, every step reflects our promise of quality and trust.</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Farm-fresh milk delivered daily</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Pure, unadulterated, and preservative-free products</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Hygienic processing with modern techniques</p>
                    <a class="btn btn-secondary rounded-pill py-3 px-5 mt-3" href="{{ route('product') }}">Explore More</a>
                </div>
                <div class="col-lg-6">
                    <div class="rounded overflow-hidden">
                        <div class="row g-0">
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                                <div class="text-center bg-primary py-5 px-4">
                                    <img class="img-fluid mb-4" src="{{ asset('assets/img/experience.png') }}" alt="">
                                    <h1 class="display-6 text-white" data-toggle="counter-up">25</h1>
                                    <span class="fs-5 fw-semi-bold text-secondary">Years of Experience</span>
                                </div>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                                <div class="text-center bg-secondary py-5 px-4">
                                    <img class="img-fluid mb-4" src="{{ asset('assets/img/award.png') }}" alt="">
                                    <h1 class="display-6" data-toggle="counter-up">183</h1>
                                    <span class="fs-5 fw-semi-bold text-primary">Quality Certifications</span>
                                </div>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s">
                                <div class="text-center bg-secondary py-5 px-4">
                                    <img class="img-fluid mb-4" src="{{ asset('assets/img/animal.png') }}" alt="">
                                    <h1 class="display-6" data-toggle="counter-up">2619</h1>
                                    <span class="fs-5 fw-semi-bold text-primary">Healthy Cattle</span>
                                </div>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.7s">
                                <div class="text-center bg-primary py-5 px-4">
                                    <img class="img-fluid mb-4" src="{{ asset('assets/img/client.png') }}" alt="">
                                    <h1 class="display-6 text-white" data-toggle="counter-up">51940</h1>
                                    <span class="fs-5 fw-semi-bold text-secondary">Happy Families</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">

                <!-- Office Info -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Our Office</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Milkly Dairy Pvt. Ltd, Mumbai, India</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+91 98765 43210</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>support@milkly.com</p>
                    <div class="d-flex pt-3">
                        <a class="btn btn-square btn-secondary rounded-circle me-2" href="#"><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-secondary rounded-circle me-2" href="#"><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-secondary rounded-circle me-2" href="#"><i
                                class="fab fa-instagram"></i></a>
                        <a class="btn btn-square btn-secondary rounded-circle me-2" href="#"><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Quick Links</h5>
                    <a class="btn btn-link" href="#">About Us</a>
                    <a class="btn btn-link" href="#">Contact Us</a>
                    <a class="btn btn-link" href="#">Our Services</a>
                    <a class="btn btn-link" href="#">Privacy Policy</a>
                    <a class="btn btn-link" href="#">Refund Policy</a>
                </div>

                <!-- Business Hours -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Business Hours</h5>
                    <p class="mb-1">Monday - Friday</p>
                    <h6 class="text-light">06:00 am - 08:00 pm</h6>
                    <p class="mb-1">Saturday</p>
                    <h6 class="text-light">06:00 am - 06:00 pm</h6>
                    <p class="mb-1">Sunday</p>
                    <h6 class="text-light">Closed</h6>
                </div>

                <!-- Newsletter -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Newsletter</h5>
                    <p>Subscribe for fresh dairy updates, offers & healthy recipes.</p>
                    <div class="position-relative w-100">
                        <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="email"
                            placeholder="Your email">
                        <button type="button" class="btn btn-secondary py-2 position-absolute top-0 end-0 mt-2 me-2">Sign
                            Up</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Footer End -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        $(function () {
    $('.add-to-cart, .add-to-wishlist').click(function (e) {
        e.preventDefault();
        const url = $(this).data('url');

        $.post(url, { _token: "{{ csrf_token() }}" }, function (res) {
            alert(res.message);
        }).fail(function(xhr){
            if(xhr.status === 401){
                alert('Please login first!');
            } else {
                alert('Something went wrong');
            }
        });
    });
});

    </script>

@endsection