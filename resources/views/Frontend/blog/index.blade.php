@extends('Frontend.Layouts.main')

@section('title')
Blog
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
                                {{-- <li><a href="{{route('frontend.blog',$blog->slug)}}">Blog</a></li> --}}
                            </ul>
                            <h1 class="mil-mb-60">Exploring <span class="mil-thin">the World</span> <br> Through Our <span class="mil-thin">Blog</span></h1>
                            <a href="#blog" class="mil-link mil-dark mil-arrow-place mil-down-arrow">
                                <span>Publications</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- banner end -->

                <!-- popular -->
                <section class="mil-soft-bg" id="blog">
                    <div class="container mil-p-120-60">
                        <div class="row align-items-center mil-mb-30">
                            <div class="col-lg-6 mil-mb-30">
                                <h3 class="mil-up">Popular Publications:</h3>
                            </div>
                            <div class="col-lg-6 mil-mb-30">
                                <div class="mil-adaptive-right mil-up">
                                    <a href="blog-inner.html" class="mil-link mil-dark mil-arrow-place">
                                        <span>View all</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">

                                <a href="{{route('frontend.publication')}}" class="mil-blog-card mil-mb-60">
                                    <div class="mil-cover-frame mil-up">
                                        <img src="img/blog/1.jpg" alt="cover">
                                    </div>
                                    <div class="mil-post-descr">
                                        <div class="mil-labels mil-up mil-mb-30">
                                            <div class="mil-label mil-upper mil-accent">TECHNOLOGY</div>
                                            <div class="mil-label mil-upper">may 24 2023</div>
                                        </div>
                                        <h4 class="mil-up mil-mb-30">How to Become a Graphic Designer in 10 Simple Steps</h4>
                                        <p class="mil-post-text mil-up mil-mb-30">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius sequi commodi dignissimos optio, beatae, eos necessitatibus nisi. Nam cupiditate consectetur nostrum qui! Repellat natus nulla, nisi aliquid, asperiores impedit tempora sequi est reprehenderit cumque explicabo, dicta. Rem nihil ullam totam ea voluptas quibusdam repudiandae id ut at iure! Totam, a!</p>
                                        <div class="mil-link mil-dark mil-arrow-place mil-up">
                                            <span>Read more</span>
                                        </div>
                                    </div>
                                </a>

                            </div>
                            <div class="col-lg-6">

                                <a href="{{route('frontend.publication')}}" class="mil-blog-card mil-mb-60">
                                    <div class="mil-cover-frame mil-up">
                                        <img src="img/blog/2.jpg" alt="cover">
                                    </div>
                                    <div class="mil-post-descr">
                                        <div class="mil-labels mil-up mil-mb-30">
                                            <div class="mil-label mil-upper mil-accent">TECHNOLOGY</div>
                                            <div class="mil-label mil-upper">may 24 2023</div>
                                        </div>
                                        <h4 class="mil-up mil-mb-30">16 Best Graphic Design Online and Offline Courses</h4>
                                        <p class="mil-post-text mil-up mil-mb-30">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius sequi commodi dignissimos optio, beatae, eos necessitatibus nisi. Nam cupiditate consectetur nostrum qui! Repellat natus nulla, nisi aliquid, asperiores impedit tempora sequi est reprehenderit cumque explicabo, dicta. Rem nihil ullam totam ea voluptas quibusdam repudiandae id ut at iure! Totam, a!</p>
                                        <div class="mil-link mil-dark mil-arrow-place mil-up">
                                            <span>Read more</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- popular end -->

                <!-- blog -->
                <section>
                    <div class="container mil-p-120-120">
                        <div class="row align-items-center mil-mb-30">
                            <div class="col-lg-4 mil-mb-30">
                                <h3 class="mil-up">Categories:</h3>
                            </div>
                            <div class="col-lg-8 mil-mb-30">
                                <div class="mil-adaptive-right mil-up">

                                    <ul class="mil-category-list">
                                        <li><a href="blog-inner.html">Design</a></li>
                                        <li><a href="blog-inner.html">Art</a></li>
                                        <li><a href="blog-inner.html">Code</a></li>
                                        <li><a href="blog-inner.html">Technology</a></li>
                                        <li><a href="blog-inner.html" class="mil-active">All categories</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">

                                <a href="publication.html" class="mil-blog-card mil-blog-card-hori mil-more mil-mb-60">
                                    <div class="mil-cover-frame mil-up">
                                        <img src="img/blog/3.jpg" alt="cover">
                                    </div>
                                    <div class="mil-post-descr">
                                        <div class="mil-labels mil-up mil-mb-30">
                                            <div class="mil-label mil-upper mil-accent">TECHNOLOGY</div>
                                            <div class="mil-label mil-upper">may 24 2023</div>
                                        </div>
                                        <h4 class="mil-up mil-mb-30">How to Create a Brand Guide for Your Client</h4>
                                        <p class="mil-post-text mil-up mil-mb-30">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius sequi commodi dignissimos optio, beatae, eos necessitatibus nisi. Nam cupiditate consectetur nostrum qui! Repellat natus nulla, nisi aliquid, asperiores impedit tempora sequi est reprehenderit cumque explicabo, dicta. Rem nihil ullam totam ea voluptas quibusdam repudiandae id ut at iure! Totam, a!</p>
                                        <div class="mil-link mil-dark mil-arrow-place mil-up">
                                            <span>Read more</span>
                                        </div>
                                    </div>
                                </a>

                            </div>
                            <div class="col-lg-12">

                                <a href="publication.html" class="mil-blog-card mil-blog-card-hori mil-more mil-mb-60">
                                    <div class="mil-cover-frame mil-up">
                                        <img src="img/blog/4.jpg" alt="cover">
                                    </div>
                                    <div class="mil-post-descr">
                                        <div class="mil-labels mil-up mil-mb-30">
                                            <div class="mil-label mil-upper mil-accent">TECHNOLOGY</div>
                                            <div class="mil-label mil-upper">may 24 2023</div>
                                        </div>
                                        <h4 class="mil-up mil-mb-30">Color Psychology in Art and Design</h4>
                                        <p class="mil-post-text mil-up mil-mb-30">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius sequi commodi dignissimos optio, beatae, eos necessitatibus nisi. Nam cupiditate consectetur nostrum qui! Repellat natus nulla, nisi aliquid, asperiores impedit tempora sequi est reprehenderit cumque explicabo, dicta. Rem nihil ullam totam ea voluptas quibusdam repudiandae id ut at iure! Totam, a!</p>
                                        <div class="mil-link mil-dark mil-arrow-place mil-up">
                                            <span>Read more</span>
                                        </div>
                                    </div>
                                </a>

                            </div>
                            <div class="col-lg-12">

                                <a href="publication.html" class="mil-blog-card mil-blog-card-hori mil-more mil-mb-60">
                                    <div class="mil-cover-frame mil-up">
                                        <img src="img/blog/5.jpg" alt="cover">
                                    </div>
                                    <div class="mil-post-descr">
                                        <div class="mil-labels mil-up mil-mb-30">
                                            <div class="mil-label mil-upper mil-accent">TECHNOLOGY</div>
                                            <div class="mil-label mil-upper">may 24 2023</div>
                                        </div>
                                        <h4 class="mil-up mil-mb-30">How to Design a Repeating Pattern</h4>
                                        <p class="mil-post-text mil-up mil-mb-30">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius sequi commodi dignissimos optio, beatae, eos necessitatibus nisi. Nam cupiditate consectetur nostrum qui! Repellat natus nulla, nisi aliquid, asperiores impedit tempora sequi est reprehenderit cumque explicabo, dicta. Rem nihil ullam totam ea voluptas quibusdam repudiandae id ut at iure! Totam, a!</p>
                                        <div class="mil-link mil-dark mil-arrow-place mil-up">
                                            <span>Read more</span>
                                        </div>
                                    </div>
                                </a>

                            </div>
                            <div class="col-lg-12">

                                <a href="{{route('frontend.publication').'/'.$}}" class="mil-blog-card mil-blog-card-hori mil-more mil-mb-60">
                                    <div class="mil-cover-frame mil-up">
                                        <img src="img/blog/6.jpg" alt="cover">
                                    </div>
                                    <div class="mil-post-descr">
                                        <div class="mil-labels mil-up mil-mb-30">
                                            <div class="mil-label mil-upper mil-accent">TECHNOLOGY</div>
                                            <div class="mil-label mil-upper">may 24 2023</div>
                                        </div>
                                        <h4 class="mil-up mil-mb-30">How to Never Reach Creative Burnout</h4>
                                        <p class="mil-post-text mil-up mil-mb-30">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius sequi commodi dignissimos optio, beatae, eos necessitatibus nisi. Nam cupiditate consectetur nostrum qui! Repellat natus nulla, nisi aliquid, asperiores impedit tempora sequi est reprehenderit cumque explicabo, dicta. Rem nihil ullam totam ea voluptas quibusdam repudiandae id ut at iure! Totam, a!</p>
                                        <div class="mil-link mil-dark mil-arrow-place mil-up">
                                            <span>Read more</span>
                                        </div>
                                    </div>
                                </a>

                            </div>
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