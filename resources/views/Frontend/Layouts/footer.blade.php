<footer class="mil-dark-bg">
    <div class="mi-invert-fix">
        <div class="container mil-p-120-60">
            <div class="row justify-content-between">
                <div class="col-md-4 col-lg-4 mil-mb-60">

                    <div class="mil-muted mil-logo mil-up mil-mb-30">{{$siteinfo->company_name}}</div>

                    <p class="mil-light-soft mil-up mil-mb-30">Subscribe our newsletter:</p>

                    <form class="mil-subscribe-form mil-up">
                        <input type="text" placeholder="Enter our email">
                        <button type="submit" class="mil-button mil-icon-button-sm mil-arrow-place"></button>
                    </form>

                </div>
                <div class="col-md-7 col-lg-6">
                    <div class="row justify-content-end">
                        <div class="col-md-6 col-lg-7">

                            <nav class="mil-footer-menu mil-mb-60">
                                <ul>
                                    <li class="mil-up mil-active">
                                        <a href="{{route('frontend.home')}}">Home</a>
                                    </li>
                                    <li class="mil-up">
                                        <a href="{{route('frontend.portfolio')}}">Portfolio</a>
                                    </li>
                                    <li class="mil-up">
                                        <a href="{{route('frontend.services')}}">Services</a>
                                    </li>
                                    <li class="mil-up">
                                        <a href="{{route('frontend.contact')}}">Contact</a>
                                    </li>
                                    <li class="mil-up">
                                        <a href="{{route('frontend.blog')}}">Blog</a>
                                    </li>
                                </ul>
                            </nav>

                        </div>
                        <div class="col-md-6 col-lg-5">

                            <ul class="mil-menu-list mil-up mil-mb-60">
                                <li><a href="#." class="mil-light-soft">Privacy Policy</a></li>
                                <li><a href="#." class="mil-light-soft">Terms and conditions</a></li>
                                <li><a href="#." class="mil-light-soft">Cookie Policy</a></li>
                                <li><a href="#." class="mil-light-soft">Careers</a></li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-between flex-sm-row-reverse">
                <div class="col-md-7 col-lg-6">

                    <div class="row justify-content-between">

                        <div class="col-md-6 col-lg-5 mil-mb-60">

                            <h6 class="mil-muted mil-up mil-mb-30">{{$siteinfo->company_location}}</h6>

                            <p class="mil-light-soft mil-up"><span class="mil-no-wrap">{{$siteinfo->contact_number}}</span></p>

                        </div>
                    </div>

                </div>
                <div class="col-md-4 col-lg-6 mil-mb-60">

                    <div class="mil-vert-between">
                        <div class="mil-mb-30">
                            <ul class="mil-social-icons mil-up">
                                <li><a href="#." target="_blank" class="social-icon"> <i class="far fa-circle"></i></a></li>
                                <li><a href="#." target="_blank" class="social-icon"> <i class="far fa-circle"></i></a></li>
                                <li><a href="#." target="_blank" class="social-icon"> <i class="far fa-circle"></i></a></li>
                                <li><a href="#." target="_blank" class="social-icon"> <i class="far fa-circle"></i></a></li>
                            </ul>
                        </div>
                        <p class="mil-light-soft mil-up">{{$siteinfo->copyright}}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</footer>