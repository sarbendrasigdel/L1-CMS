@extends('Frontend.Layouts.main')

@section('title')
Blog-Categories
@endsection

@section('content')

                <!-- banner -->
                <div class="mil-inner-banner mil-p-0-120">
                    <div class="mil-banner-content mil-up">
                        <div class="mil-animation-frame">
                            <div class="mil-animation mil-position-4 mil-dark mil-scale" data-value-1="6" data-value-2="1.4"></div>
                        </div>
                        <div class="container">
                            <ul class="mil-breadcrumbs mil-mb-60">
                                <li><a href="{{route('frontend.home')}}">Homepage</a></li>
                                <li><a href="{{route('frontend.blog')}}">Blog</a></li>
                                <li><a href="blog-inner.html">Category page</a></li>
                            </ul>
                            <h1 class="mil-mb-60">Publications <br>Category <span class="mil-thin">Name</span></h1>
                            <a href="#blog" class="mil-link mil-dark mil-arrow-place mil-down-arrow">
                                <span>Publications</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- banner end -->

                <!-- blog -->
                <section id="blog">
                    <div class="container mil-p-120-120">
                        <div class="row align-items-center mil-mb-30">
                            <div class="col-lg-4 mil-mb-30">
                                <h3 class="mil-up">Other categories:</h3>
                            </div>
                            <div class="col-lg-8 mil-mb-30">
                                <div class="mil-adaptive-right mil-up">

                                    <ul class="mil-category-list">
                                        @foreach($categories as $category)
                                        <li><a href="blog-inner.html">{{$category->name}}</a></li>
                                        @endforeach
                                        <li><a href="blog-inner.html"class="mil-active">All categories</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($blog as $blog)
                            <div class="col-lg-12">

                                <a href="{{route('frontend.publication',$blog->slug)}}" class="mil-blog-card mil-blog-card-hori mil-more mil-mb-60">
                                    <div class="mil-cover-frame mil-up">
                                        <img src="{{$blog->image}}" alt="cover">
                                    </div>
                                    <div class="mil-post-descr">
                                        <div class="mil-labels mil-up mil-mb-30">
                                            <div class="mil-label mil-upper mil-accent">{{$blog->category->name}}</div>
                                            <div class="mil-label mil-upper">may 24 2023</div>
                                        </div>
                                        <h4 class="mil-up mil-mb-30">{{$blog->title}}</h4>
                                        <p class="mil-post-text mil-up mil-mb-30">{{strip_tags(Str::limit($blog->description, 100, '...'))}}</p>
                                        <div class="mil-link mil-dark mil-arrow-place mil-up">
                                            <span>Read more</span>
                                        </div>
                                    </div>
                                </a>

                            </div>
                            @endforeach
                            <div class="col-lg-12">
                                <div class="mil-pagination">
                                    <a href="blog-inner.html" class="mil-pagination-btn mil-active">1</a>
                                    <a href="blog-inner.html" class="mil-pagination-btn">2</a>
                                    <a href="blog-inner.html" class="mil-pagination-btn">3</a>
                                    <a href="blog-inner.html" class="mil-pagination-btn">4</a>
                                    <a href="blog-inner.html" class="mil-pagination-btn">5</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- blog end -->

                <!-- call to action -->
                <section class="mil-soft-bg">
                    <div class="container mil-p-120-120">
                        <div class="row">
                            <div class="col-lg-10">

                                <span class="mil-suptitle mil-suptitle-right mil-suptitle-dark mil-up">Looking to make your mark? We'll help you turn <br> your project into a success story.</span>

                            </div>
                        </div>
                        <div class="mil-center">
                            <h2 class="mil-up mil-mb-60">Stay up-to-date <span class="mil-thin">with the</span><br> latest news by <span class="mil-thin">subscribing</span><br> to our <span class="mil-thin">newsletter!</span></h2>
                            <div class="row justify-content-center mil-up">
                                <div class="col-lg-4">
                                    <form class="mil-subscribe-form mil-subscribe-form-2 mil-up">
                                        <input type="text" placeholder="Enter our email">
                                        <button type="submit" class="mil-button mil-icon-button-sm mil-arrow-place"></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- call to action end -->
@endsection