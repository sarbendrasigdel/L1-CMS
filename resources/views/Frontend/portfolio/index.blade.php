@extends('Frontend.Layouts.main')

@section('title')
Portfolio
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
                            </ul>
                            <h1 class="mil-mb-60">Designing a <br> Better <span class="mil-thin">World Today</span></h1>
                            <a href="#portfolio" class="mil-link mil-dark mil-arrow-place mil-down-arrow">
                                <span>Our works</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- banner end -->
                                <!-- portfolio -->
                                <section id="portfolio">
                                    <div class="container mil-portfolio mil-p-120-60">
                
                                        <div class="mil-lines-place"></div>
                                        <div class="mil-lines-place mil-lines-long"></div>
                
                                        <div class="row justify-content-between align-items-center">
                                            @foreach($portfolio as $portfolio)
                                            <div class="col-lg-6">
                
                                                <a href="{{route('frontend.project',$portfolio->slug)}}" class="mil-portfolio-item mil-more mil-mb-60">
                                                    <div class="mil-cover-frame mil-vert mil-up">
                                                        <div class="mil-cover">
                                                            <img src="{{$portfolio->image}}" alt="cover">
                                                        </div>
                                                    </div>
                                                    <div class="mil-descr">
                                                        <div class="mil-labels mil-up mil-mb-15">
                                                            <div class="mil-label mil-upper mil-accent">{{$portfolio->client}}</div>
                                                            <div class="mil-label mil-upper">may 24 2023</div>
                                                        </div>
                                                        <h4 class="mil-up">{{$portfolio->title}}</h4>
                                                    </div>
                                                </a>
                
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </section>
                                <!-- portfolio end -->
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