@extends('Frontend.Layouts.main')
@section('title')
service
@endsection

@section('content')
                <!-- banner -->
                <div class="mil-inner-banner">
                    <div class="mil-animation-frame">
                        <div class="mil-animation mil-position-4 mil-dark mil-scale" data-value-1="6" data-value-2="1.4"></div>
                    </div>
                    <div class="mil-banner-content mil-up">
                        <div class="container">
                            <ul class="mil-breadcrumbs mil-mb-60">
                                <li><a href="{{route('frontend.home')}}">Homepage</a></li>
                                <li><a href="{{route('frontend.services')}}">Services</a></li>
                                <li><a href="service.html">Service</a></li>
                            </ul>
                            <h1 class="mil-mb-60">{{$service->title}}</h1>
                            <a href="#service" class="mil-link mil-dark mil-arrow-place mil-down-arrow">
                                <span>About service</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- banner end -->
                                <!-- service -->
                                <section id="service">
                                    <div class="container mil-p-120-90">
                                        <div class="row justify-content-between">
                                            <div class="col-lg-4 mil-relative mil-mb-90">
                
                                                {{-- <h4 class="mil-up mil-mb-30">Your <span class="mil-thin">Approach</span> <br>and <span class="mil-thin">Work Specifics</span></h4> --}}
                                                <p class="mil-up mil-mb-30">{{$service->description}}</p>
                                                <div class="mil-up">
                                                    <a href="portfolio-3.html" class="mil-link mil-dark mil-arrow-place">
                                                        <span>View works</span>
                                                    </a>
                                                </div>
                
                                            </div>
                                            <div class="col-lg-6">
                                                @foreach($service_features as $feature)
                                                <div class="mil-accordion-group mil-up">
                                                    <div class="mil-accordion-menu">
                
                                                        <p class="mil-accordion-head">{{$feature->name}}</p>
                
                                                        <div class="mil-symbol mil-h3">
                                                            <div class="mil-plus">+</div>
                                                            <div class="mil-minus">-</div>
                                                        </div>
                
                                                    </div>
                                                    <div class="mil-accordion-content">
                                                        <p class="mil-mb-30">{{$feature->description}}</p>
                                                    </div>
                                                </div>
                                                @endforeach
                
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- service end -->
                                                <!-- prices -->
                <section class="mil-dark-bg">
                    <div class="mi-invert-fix">
                        <div class="container mil-p-120-120">
                            <div class="mil-center">
                                <h2 class="mil-muted mil-up mil-mb-30">Reasonable <span class="mil-thin">prices</span> <br>for innovative <span class="mil-thin">solutions</span></h2>
                                <p class="mil-light-soft mil-up mil-mb-120">At our agency, we have a unique approach to web design and development. <br>We believe in creating in terms of user experience, functionality.</p>
                            </div>

                            <a href="contact.html" class="mil-price-card mil-choose mil-accent-cursor mil-up">
                                <div class="row align-items-center">
                                    <div class="col-lg-2">
                                        <div class="mil-price-number mil-mb-30"><span class="mil-muted mil-thin">$</span><span class="mil-accent">19</span></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <h5 class="mil-muted mil-mb-30">Tailored Designs for<br> Every Budget</h5>
                                    </div>
                                    <div class="col-lg-4">
                                        <p class="mil-light-soft mil-mb-30">Tomlo commodi, mollitia atque betae esse itaque a, voluptatibus, suscipit beatae officiis omnis.</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mil-adaptive-right mil-mb-30">
                                            <div class="mil-button mil-icon-button-sm mil-arrow-place"></div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="contact.html" class="mil-price-card mil-choose mil-accent-cursor mil-up">
                                <div class="row align-items-center">
                                    <div class="col-lg-2">
                                        <div class="mil-price-number mil-mb-30"><span class="mil-muted mil-thin">$</span><span class="mil-accent">29</span></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <h5 class="mil-muted mil-mb-30">Inspiring and Customized <br> Design Solutions</h5>
                                    </div>
                                    <div class="col-lg-4">
                                        <p class="mil-light-soft mil-mb-30">Tomlo commodi, mollitia atque betae esse itaque a, voluptatibus, suscipit beatae officiis omnis.</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mil-adaptive-right mil-mb-30">
                                            <div class="mil-button mil-icon-button-sm mil-arrow-place"></div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="contact.html" class="mil-price-card mil-choose mil-accent-cursor mil-up">
                                <div class="row align-items-center">
                                    <div class="col-lg-2">
                                        <div class="mil-price-number mil-mb-30"><span class="mil-muted mil-thin">$</span><span class="mil-accent">49</span></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <h5 class="mil-muted mil-mb-30">Unleashing the Beauty of Space <br> with Unique Designs</h5>
                                    </div>
                                    <div class="col-lg-4">
                                        <p class="mil-light-soft mil-mb-30">Tomlo commodi, mollitia atque betae esse itaque a, voluptatibus, suscipit beatae officiis omnis.</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mil-adaptive-right mil-mb-30">
                                            <div class="mil-button mil-icon-button-sm mil-arrow-place"></div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="contact.html" class="mil-price-card mil-choose mil-accent-cursor mil-up mil-mb-60">
                                <div class="row align-items-center">
                                    <div class="col-lg-2">
                                        <div class="mil-price-number mil-mb-30"><span class="mil-muted mil-thin">$</span><span class="mil-accent">199</span></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <h5 class="mil-muted mil-mb-30">Exquisite Design Concepts <br> for Discerning Clients</h5>
                                    </div>
                                    <div class="col-lg-4">
                                        <p class="mil-light-soft mil-mb-30">Tomlo commodi, mollitia atque betae esse itaque a, voluptatibus, suscipit beatae officiis omnis.</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mil-adaptive-right mil-mb-30">
                                            <div class="mil-button mil-icon-button-sm mil-arrow-place"></div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <div class="mil-center">
                                <a href="contact.html" class="mil-button  mil-arrow-place">
                                    <span>individual solution</span>
                                </a>
                            </div>

                        </div>
                    </div>
                </section>
                <!-- prices end -->
@endsection