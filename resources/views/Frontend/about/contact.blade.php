@extends('Frontend.Layouts.main')

@section('title')
Contact Us
@endsection

@section('content')
<!-- banner -->
<div class="mil-inner-banner mil-p-0-120">
    <div class="mil-banner-content mil-center mil-up">
        <div class="container">
            <ul class="mil-breadcrumbs mil-center mil-mb-60">
                <li><a href="{{route('frontend.home')}}">Homepage</a></li>
                <li><a href="{{route('frontend.contact')}}">Contact</a></li>
            </ul>
            <h1 class="mil-mb-60">Get in touch!</h1>
            <a href="#contact" class="mil-link mil-dark mil-arrow-place mil-down-arrow">
                <span>Send message</span>
            </a>
        </div>
    </div>
</div>
<!-- banner end -->
                <!-- map -->
                <div class="mil-map-frame mil-up">
                    <div class="mil-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1396.5769090312324!2d-73.6519672!3d45.5673453!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4cc91f8abc30e0ff%3A0xfc6d9cbb49022e9c!2sManoir%20Saint-Joseph!5e0!3m2!1sen!2sua!4v1685485811069!5m2!1sen!2sua" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <!-- map end -->
                <!-- contact form -->
                <section id="contact">
                    <div class="container mil-p-120-90">
                        <h3 class="mil-center mil-up mil-mb-120">Let's <span class="mil-thin">Talk</span></h3>
                        <form class="row align-items-center" id="contact-from">
                            @csrf
                            <div class="col-lg-6 mil-up">
                                <input type="text" placeholder="What's your name" name="name" id="name" required>
                            </div>
                            <div class="col-lg-6 mil-up">
                                <input type="email" placeholder="Your Email" name ="email" id="email" required>
                            </div>
                            <div class="col-lg-12 mil-up">
                                <textarea placeholder="Tell us about our project" name="description" id="description" required></textarea>
                            </div>
                            <div class="col-lg-8">
                                <p class="mil-up mil-mb-30"><span class="mil-accent">*</span> We promise not to disclose your personal information to third parties.</p>
                            </div>
                            <div class="col-lg-4">
                                <div class="mil-adaptive-right mil-up mil-mb-30">
                                    <button type="submit" class="mil-button mil-arrow-place add-btn" >
                                        <span>Send message</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
                <!-- contact form end -->

@endsection
@section('additional-js')
<script src="{{asset('Frontend/custom/js/contact.js')}}"></script>
@endsection