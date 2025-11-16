@extends('layout.app')

@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid px-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ asset('assets/img/carousel-1.jpg') }}" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-lg-8 text-start">
                                    <p class="fs-4 text-white">Welcome to our dairy farm</p>
                                    <h1 class="display-1 text-white mb-5 animated slideInRight">The Farm of Dairy products
                                    </h1>
                                    <a href="{{ route('product') }}"
                                        class="btn btn-secondary rounded-pill py-3 px-5 animated slideInRight">Explore
                                        More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{ asset('assets/img/carousel-2.jpg') }}" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-end">
                                <div class="col-lg-8 text-end">
                                    <p class="fs-4 text-white">Welcome to our dairy farm</p>
                                    <h1 class="display-1 text-white mb-5 animated slideInRight">Best Organic Dairy Products
                                    </h1>
                                    <a href="{{ route('product') }}" class="btn btn-secondary rounded-pill py-3 px-5 animated slideInLeft">Explore
                                        More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-end">
                <div class="col-lg-6">
                    <div class="row g-2">
                        <div class="col-6 position-relative wow fadeIn" data-wow-delay="0.7s">
                            <div class="about-experience bg-secondary rounded">
                                <h1 class="display-1 mb-0">25</h1>
                                <small class="fs-5 fw-bold">Years of Trust</small>
                            </div>
                        </div>
                        <div class="col-6 wow fadeIn" data-wow-delay="0.1s">
                            <img class="img-fluid rounded" src="{{ asset('assets/img/service-1.jpg') }}">
                        </div>
                        <div class="col-6 wow fadeIn" data-wow-delay="0.3s">
                            <img class="img-fluid rounded" src="{{ asset('assets/img/service-2.jpg') }}">
                        </div>
                        <div class="col-6 wow fadeIn" data-wow-delay="0.5s">
                            <img class="img-fluid rounded" src="{{ asset('assets/img/service-3.jpg') }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <p class="section-title bg-white text-start text-primary pe-3">About Us</p>
                    <h1 class="mb-4">Our Journey in Delivering Fresh & Pure Dairy</h1>
                    <p class="mb-4">Started with a simple promise — to bring farm-fresh milk and dairy to every Indian home
                        — we have been serving families with purity, taste, and nutrition for over two decades. From our
                        cows to your cup, every step is guided by care, hygiene, and a commitment to quality.</p>
                    <div class="row g-5 pt-2 mb-5">
                        <div class="col-sm-6">
                            <img class="img-fluid mb-4" src="{{ asset('assets/img/service.png') }}" alt="">
                            <h5 class="mb-3">Trusted Service</h5>
                            <span>Daily doorstep delivery of fresh milk and dairy products, ensuring convenience and
                                consistency.</span>
                        </div>
                        <div class="col-sm-6">
                            <img class="img-fluid mb-4" src="{{ asset('assets/img/product.png') }}" alt="">
                            <h5 class="mb-3">100% Pure & Organic</h5>
                            <span>Our products are free from preservatives and adulteration, keeping the natural goodness
                                intact.</span>
                        </div>
                    </div>
                    <a class="btn btn-secondary rounded-pill py-3 px-5" href="{{ route('product') }}">Explore More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->



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



    <!-- Banner Start -->
    <div class="container-fluid banner my-5 py-5" data-parallax="scroll"
        data-image-src="{{ asset('assets/img/banner.jpg') }}">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.3s">
                    <div class="row g-4 align-items-center">
                        <div class="col-sm-4">
                            <img class="img-fluid rounded" src="{{ asset('assets/img/banner-1.jpg') }}" alt="">
                        </div>
                        <div class="col-sm-8">
                            <h2 class="text-white mb-3">Pure & Quality Dairy Products</h2>
                            <p class="text-white mb-4">From farm-fresh milk to ghee, curd, paneer, and more – we bring you
                                nutritious dairy made with care and hygiene.</p>
                            <a class="btn btn-secondary rounded-pill py-2 px-4" href="">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="row g-4 align-items-center">
                        <div class="col-sm-4">
                            <img class="img-fluid rounded" src="{{ asset('assets/img/banner-2.jpg') }}" alt="">
                        </div>
                        <div class="col-sm-8">
                            <h2 class="text-white mb-3">Daily Fresh Milk at Your Doorstep</h2>
                            <p class="text-white mb-4">Delivered every morning, our milk retains its natural taste and
                                nutrition – trusted by thousands of Indian families.</p>
                            <a class="btn btn-secondary rounded-pill py-2 px-4" href="">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->



    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="section-title bg-white text-center text-primary px-3">Our Services</p>
                <h1 class="mb-5">What We Provide to Our Customers</h1>
            </div>
            <div class="row gy-5 gx-4">
                <div class="col-lg-4 col-md-6 pt-5 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item d-flex h-100">
                        <div class="service-img">
                            <img class="img-fluid" src="{{ asset('assets/img/service-1.jpg') }}" alt="">
                        </div>
                        <div class="service-text p-5 pt-0">
                            <div class="service-icon">
                                <img class="img-fluid rounded-circle" src="{{ asset('assets/img/service-1.jpg') }}" alt="">
                            </div>
                            <h5 class="mb-3">Healthy Cattle Care</h5>
                            <p class="mb-4">We ensure our cows and buffaloes are raised with proper nutrition, comfort, and
                                veterinary support for quality milk production.</p>
                            <a class="btn btn-square rounded-circle" href=""><i class="bi bi-chevron-double-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pt-5 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item d-flex h-100">
                        <div class="service-img">
                            <img class="img-fluid" src="{{ asset('assets/img/service-2.jpg') }}" alt="">
                        </div>
                        <div class="service-text p-5 pt-0">
                            <div class="service-icon">
                                <img class="img-fluid rounded-circle" src="{{ asset('assets/img/service-2.jpg') }}" alt="">
                            </div>
                            <h5 class="mb-3">Quality & Hygiene</h5>
                            <p class="mb-4">From milking to packaging, we follow strict hygiene practices so that every drop
                                of milk is pure, safe, and nutritious.</p>
                            <a class="btn btn-square rounded-circle" href=""><i class="bi bi-chevron-double-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pt-5 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item d-flex h-100">
                        <div class="service-img">
                            <img class="img-fluid" src="{{ asset('assets/img/service-3.jpg') }}" alt="">
                        </div>
                        <div class="service-text p-5 pt-0">
                            <div class="service-icon">
                                <img class="img-fluid rounded-circle" src="{{ asset('assets/img/service-3.jpg') }}" alt="">
                            </div>
                            <h5 class="mb-3">Doorstep Delivery</h5>
                            <p class="mb-4">Fresh milk and dairy products are delivered every morning to your home, ensuring
                                convenience and reliability for your family.</p>
                            <a class="btn btn-square rounded-circle" href=""><i class="bi bi-chevron-double-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->



    <!-- Gallery Start -->
    <div class="container-xxl py-5 px-0">
        <div class="container pb-5 text-center wow fadeInUp" data-wow-delay="0.1s">
            <p class="section-title bg-white text-center text-primary px-3">Our Gallery</p>
            <h1 class="mb-4">A Glimpse of Our Dairy & Fresh Products</h1>
            <p class="mb-5">From our healthy cattle to hygienic processing and happy customers, here’s a look at the journey
                of purity and freshness we deliver every day.</p>
        </div>
        <div class="row g-0">
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="row g-0">
                    <div class="col-12">
                        <a class="d-block" href="{{ asset('assets/img/gallery-5.jpg') }}" data-lightbox="gallery">
                            <img class="img-fluid" src="{{ asset('assets/img/gallery-5.jpg') }}" alt="">
                        </a>
                    </div>
                    <div class="col-12">
                        <a class="d-block" href="{{ asset('assets/img/gallery-1.jpg') }}" data-lightbox="gallery">
                            <img class="img-fluid" src="{{ asset('assets/img/gallery-1.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="row g-0">
                    <div class="col-12">
                        <a class="d-block" href="{{ asset('assets/img/gallery-2.jpg') }}" data-lightbox="gallery">
                            <img class="img-fluid" src="{{ asset('assets/img/gallery-2.jpg') }}" alt="">
                        </a>
                    </div>
                    <div class="col-12">
                        <a class="d-block" href="{{ asset('assets/img/gallery-6.jpg') }}" data-lightbox="gallery">
                            <img class="img-fluid" src="{{ asset('assets/img/gallery-6.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="row g-0">
                    <div class="col-12">
                        <a class="d-block" href="{{ asset('assets/img/gallery-7.jpg') }}" data-lightbox="gallery">
                            <img class="img-fluid" src="{{ asset('assets/img/gallery-7.jpg') }}" alt="">
                        </a>
                    </div>
                    <div class="col-12">
                        <a class="d-block" href="{{ asset('assets/img/gallery-3.jpg') }}" data-lightbox="gallery">
                            <img class="img-fluid" src="{{ asset('assets/img/gallery-3.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="row g-0">
                    <div class="col-12">
                        <a class="d-block" href="{{ asset('assets/img/gallery-4.jpg') }}" data-lightbox="gallery">
                            <img class="img-fluid" src="{{ asset('assets/img/gallery-4.jpg') }}" alt="">
                        </a>
                    </div>
                    <div class="col-12">
                        <a class="d-block" href="{{ asset('assets/img/gallery-8.jpg') }}" data-lightbox="gallery">
                            <img class="img-fluid" src="{{ asset('assets/img/gallery-8.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Gallery End -->



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
                                <img class="img-fluid" style="object-fit: cover;height: 300px" src="{{ asset('assets/img/product/' . $product->image) }}"
                                    alt="{{ $product->name }}">
                                <div class="product-overlay">
                                    <a class="btn btn-square btn-secondary rounded-circle m-1" href=""><i
                                            class="bi bi-link"></i></a>
                                    <a class="btn btn-square btn-secondary rounded-circle m-1" href=""><i
                                            class="bi bi-cart"></i></a>
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


    <!-- Testimonial Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="section-title bg-white text-center text-primary px-3">Testimonial</p>
                <h1 class="mb-5">What People Say About Our Dairy Farm</h1>
            </div>
            <div class="row g-5 align-items-center">
                <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="testimonial-img">
                        <img class="img-fluid animated pulse infinite" src="{{ asset('assets/img/testimonial-1.jpg') }}"
                            alt="">
                        <img class="img-fluid animated pulse infinite" src="{{ asset('assets/img/testimonial-2.jpg') }}"
                            alt="">
                        <img class="img-fluid animated pulse infinite" src="{{ asset('assets/img/testimonial-3.jpg') }}"
                            alt="">
                        <img class="img-fluid animated pulse infinite" src="{{ asset('assets/img/testimonial-4.jpg') }}"
                            alt="">
                    </div>
                </div>
                <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="owl-carousel testimonial-carousel">

                        <!-- Testimonial Item -->
                        <div class="testimonial-item">
                            <img class="img-fluid mb-3 rounded-circle" src="{{ asset('assets/img/testimonial-1.jpg') }}"
                                alt="">
                            <p class="fs-5">“The milk from this farm is so fresh and pure! My kids love it, and I feel safe
                                knowing it’s chemical-free.”</p>
                            <h5>Priya Sharma</h5>
                            <span class="text-primary">Homemaker</span>
                        </div>

                        <!-- Testimonial Item -->
                        <div class="testimonial-item">
                            <img class="img-fluid mb-3 rounded-circle" src="{{ asset('assets/img/testimonial-2.jpg') }}"
                                alt="">
                            <p class="fs-5">“As a café owner, I need reliable dairy suppliers. Their paneer and curd are
                                consistently high-quality.”</p>
                            <h5>Rohit Mehta</h5>
                            <span class="text-primary">Café Owner</span>
                        </div>

                        <!-- Testimonial Item -->
                        <div class="testimonial-item">
                            <img class="img-fluid mb-3 rounded-circle" src="{{ asset('assets/img/testimonial-3.jpg') }}"
                                alt="">
                            <p class="fs-5">“I’ve tried many dairy brands, but this farm stands out. Their ghee has an
                                authentic taste that reminds me of home.”</p>
                            <h5>Neha Patel</h5>
                            <span class="text-primary">Nutritionist</span>
                        </div>

                        <!-- Testimonial Item -->
                        <div class="testimonial-item">
                            <img class="img-fluid mb-3 rounded-circle" src="{{ asset('assets/img/testimonial-4.jpg') }}"
                                alt="">
                            <p class="fs-5">“Fast delivery, fresh milk, and excellent customer service. Highly recommend
                                them for daily dairy needs.”</p>
                            <h5>Arjun Verma</h5>
                            <span class="text-primary">Software Engineer</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


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

@endsection