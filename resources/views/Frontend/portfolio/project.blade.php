@extends('Frontend.Layouts.main')

@section('title')
Project
@endsection

@section('content')
                <!-- banner -->
                <div class="mil-inner-banner">
                    <div class="mil-banner-content mil-up">
                        <div class="mil-animation-frame">
                            <div class="mil-animation mil-position-4 mil-dark mil-scale" data-value-1="6" data-value-2="1.4"></div>
                        </div>
                        <div class="container">
                            <ul class="mil-breadcrumbs mil-mb-60">
                                <li><a href="{{route('frontend.home')}}">Homepage</a></li>
                                <li><a href="{{route('frontend.portfolio')}}">Portfolio</a></li>
                                <li><a href="project-1.html">Project</a></li>
                            </ul>
                            <h1 class="mil-mb-60">{{$portfolio->title}}</span></h1>
                            <a href="#project" class="mil-link mil-dark mil-arrow-place mil-down-arrow">
                                <span>Read more</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- banner end -->
                                <!-- project -->
                                <section id="project">
                                    <div class="container mil-p-120-120">
                                        <div class="swiper-container mil-1-slider mil-up">
                                            <div class="swiper-wrapper">
                                                @foreach($portfolio->images as $images)
                                                <div class="swiper-slide">
                
                                                    <div class="mil-image-frame mil-horizontal mil-drag">
                                                        <img src="{{$images->image}}" alt="image">
                                                        <a data-fancybox="gallery" data-no-swup href="img/works/3/1.jpg" class="mil-zoom-btn">
                                                            <img src="{{$images->image}}" alt="zoom">
                                                        </a>
                                                    </div>
                
                                                </div>
                                                @endforeach
                
                                            </div>
                                        </div>
                                        <div class="mil-info mil-up">
                                            <div>Client: &nbsp;<span class="mil-dark">Envato Market</span></div>
                                            <div>Date: &nbsp;<span class="mil-dark">April 2023</span></div>
                                            <div>Author: &nbsp;<span class="mil-dark">Paul Trueman</span></div>
                                        </div>
                                        <div class="row justify-content-between mil-p-120-90">
                                            <div class="col-lg-5">
                                                <h3 class="mil-up mil-mb-60">{{$portfolio->title}}</h3>
                                            </div>
                                            <div class="col-lg-6">
                                                <p class="mil-up mil-mb-30">{!!$portfolio->description!!}</p>
                                            </div>
                                        </div>
                                        <div class="mil-works-nav mil-up">
                                            <a href="project-2.html" class="mil-link mil-dark mil-arrow-place mil-icon-left">
                                                <span>Prev project</span>
                                            </a>
                                            <a href="{{route('frontend.portfolio')}}" 
                                            class="mil-link mil-dark">
                                                <span>All projects</span>
                                            </a>
                                            <a href="project-4.html" class="mil-link mil-dark mil-arrow-place">
                                                <span>Next project</span>
                                            </a>
                                        </div>
                                    </div>
                                </section>
                                <!-- project end -->
                             <!-- call to action -->
                <section class="mil-soft-bg">
                    <div class="container mil-p-120-120">
                        <div class="row">
                            <div class="col-lg-10">

                                <span class="mil-suptitle mil-suptitle-right mil-suptitle-dark mil-up">Looking to make your mark? We'll help you turn <br> your project into a success story.</span>

                            </div>
                        </div>
                        <div class="mil-center">
                            <h2 class="mil-up mil-mb-60">Ready to bring your <span class="mil-thin">ideas to</span> life? <br> We're <span class="mil-thin">here to help</span></h2>
                            <div class="mil-up"><a href="contact.html" class="mil-button mil-arrow-place"><span>Contact us</span></a></div>
                        </div>
                    </div>
                </section>
                <!-- call to action end -->
@endsection