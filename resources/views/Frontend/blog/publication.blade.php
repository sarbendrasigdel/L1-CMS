@extends('Frontend.Layouts.main')

@section('title')
Publication
@endsection

@section('content')
<!-- banner -->
<div class="mil-inner-banner">
    <div class="mil-banner-content mil-center mil-up">
        <div class="container">
            <ul class="mil-breadcrumbs mil-center mil-mb-60">
                <li><a href="{{route('frontend.home')}}">Homepage</a></li>
                <li><a href="{{route('frontend.blog')}}">Blog</a></li>
                <li><a href="blog.html">Publication</a></li>
            </ul>
            <h2>{!!$blog->title!!}</h2>
        </div>
    </div>
</div>
<!-- banner end -->

<!-- publication -->
<section id="blog">
    <div class="container mil-p-120-90">
        <div class="row justify-content-center">
            <div class="col-lg-12">

                <div class="mil-image-frame mil-horizontal mil-up">
                    <img src="{{$blog->image}}" alt="Publication cover" class="mil-scale" data-value-1=".90" data-value-2="1.15">
                </div>
                <div class="mil-info mil-up mil-mb-90">
                    <div>Category: &nbsp;<span class="mil-dark">{{$blog->category->name}}</span></div>
                    <div>Date: &nbsp;<span class="mil-dark">April 2023</span></div>
                    <div>Author: &nbsp;<span class="mil-dark">Paul Trueman</span></div>
                </div>

            </div>
            <div class="col-lg-8">
                {!!$blog->description!!}

            </div>
        </div>
    </div>
</section>
<!-- publication end -->

<!-- similar -->
<section class="mil-soft-bg">
    <div class="container mil-p-120-60">
        <div class="row align-items-center mil-mb-30">
            <div class="col-lg-6 mil-mb-30">
                <h3 class="mil-up">Similar Publications:</h3>
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
            @foreach($related_blogs as $related_blog)
            <div class="col-lg-6">

                <a href="{{route('frontend.publication',$related_blog->slug)}}" class="mil-blog-card mil-mb-60">
                    <div class="mil-cover-frame mil-up">
                        <img src="{{$related_blog->image}}" alt="cover">
                    </div>
                    <div class="mil-post-descr">
                        <div class="mil-labels mil-up mil-mb-30">
                            <div class="mil-label mil-upper mil-accent">{{$related_blog->category->name}}</div>
                            <div class="mil-label mil-upper">may 24 2023</div>
                        </div>
                        <h4 class="mil-up mil-mb-30">{{$related_blog->title}}</h4>
                        <p class="mil-post-text mil-up mil-mb-30">{!! strip_tags(Str::limit($related_blog->description,100)) !!}</p>
                        <div class="mil-link mil-dark mil-arrow-place mil-up">
                            <span>Read more</span>
                        </div>
                    </div>
                </a>

            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- similar end -->

@endsection