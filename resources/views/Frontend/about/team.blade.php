@extends('Frontend.Layouts.main')

@section('title')
Team
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
                                <li><a href="home-1.html">Homepage</a></li>
                                <li><a href="team.html">Team</a></li>
                            </ul>
                            <h1 class="mil-mb-60">Meet <span class="mil-thin">Our</span><br> Creative <span class="mil-thin">Team</span></h1>
                            <a href="#team" class="mil-link mil-dark mil-arrow-place mil-down-arrow">
                                <span>Our team</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- banner end -->

                <!-- team -->
                <section id="team">
                    <div class="container mil-p-120-90">
                        <div class="row">
                            @foreach($teams as $team)
                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="mil-team-card mil-up mil-mb-30">
                                    <img src="{{$team->image}}" alt="Team member">
                                    <div class="mil-description">
                                        <div class="mil-secrc-text">
                                            <h5 class="mil-muted mil-mb-5"><a href="home-2.html">{{$team->name}}</a></h5>
                                            <p class="mil-link mil-light-soft mil-mb-10">{{$team->position}}</p>
                                            <ul class="mil-social-icons mil-center">
                                                <li><a href="{{$team->facebook}}" target="_blank" class="social-icon"> <i class="fab fa-behance"></i></a></li>
                                                <li><a href="{{$team->instagram}}" target="_blank" class="social-icon"> <i class="fab fa-dribbble"></i></a></li>
                                                <li><a href="{{$team->twitter}}" target="_blank" class="social-icon"> <i class="fab fa-twitter"></i></a></li>
                                                <li><a href="{{$team->github}}" target="_blank" class="social-icon"> <i class="fab fa-github"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                </section>
                <!-- team end -->

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