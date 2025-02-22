@extends('Frontend.Layouts.main')

@section('title')
Services
@endsection

@section('content')
                <!-- banner -->
                <div class="mil-dark-bg">
                    <div class="mil-inner-banner">
                        <div class="mi-invert-fix">
                            <div class="mil-banner-content mil-up">
                                <div class="mil-animation-frame">
                                    <div class="mil-animation mil-position-4 mil-scale" data-value-1="6" data-value-2="1.4"></div>
                                </div>
                                <div class="container">
                                    <ul class="mil-breadcrumbs mil-light mil-mb-60">
                                        <li><a href="{{route('frontend.home')}}">Homepage</a></li>
                                        <li><a href="{{route('frontend.services')}}">Services</a></li>
                                    </ul>
                                    <h1 class="mil-muted mil-mb-60">This is <span class="mil-thin">what</span><br> we do <span class="mil-thin">best</span></h1>
                                    <a href="#services" class="mil-link mil-accent mil-arrow-place mil-down-arrow">
                                        <span>Our services</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- banner end -->

                    <!-- services -->
                    <section id="services">
                        <div class="mi-invert-fix">
                            <div class="container mil-p-120-60">
                                <div class="row">
                                    <div class="col-lg-5">

                                        <div class="mil-lines-place mil-light"></div>

                                    </div>
                                    <div class="col-lg-7">
                                        <div class="row">
                                            @foreach($service as $service)
                                            <div class="col-md-6 col-lg-6">
                                                <a href="{{route('frontend.service',$service->id)}}" class="mil-service-card-lg mil-more mil-accent-cursor mil-offset">
                                                    <h4 class="mil-muted mil-up mil-mb-30">{{$service->title}}</h4>
                                                    <p class="mil-descr mil-light-soft mil-up mil-mb-30">{{$service->description}}</p>
                                                    <ul class="mil-service-list mil-light mil-mb-30">
                                                        @foreach($service->features as $feature)
                                                        <li class="mil-up">{{$feature->name}}</li>
                                                        @endforeach
                                                    </ul>
                                                    <div class="mil-link mil-accent mil-arrow-place mil-up">
                                                        <span>Read more</span>
                                                    </div>
                                                </a>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- services end -->
                                <!-- call to action -->
                                <section class="mil-soft-bg">
                                    <div class="container mil-p-120-120">
                                        <div class="row">
                                            <div class="col-lg-10">
                
                                                <span class="mil-suptitle mil-suptitle-right mil-suptitle-dark mil-up">Looking to make your mark? We'll help you turn <br> your project into a success story.</span>
                
                                            </div>
                                        </div>
                                        <div class="mil-center">
                                            <h2 class="mil-up mil-mb-60">Let’s make an <span class="mil-thin">impact</span><br> together. Ready <span class="mil-thin">when you are</span></h2>
                                            <div class="mil-up"><a href="{{route('frontend.contact')}}" class="mil-button mil-arrow-place"><span>Contact us</span></a></div>
                                        </div>
                                    </div>
                                </section>
                                <!-- call to action end -->
@endsection