<div class="tab-pane fade @if(@$menu == 'homepage') active show @endif" id="homepage" role="tabpanel" aria-labelledby="homepage-tab">

    @php $loggedInUser = \Illuminate\Support\Facades\Auth::guard('admin-user')->user() @endphp

    @can('view.user')

    <div class="dropdown">
        <a class="drop-sub @if(@$subMenu == 'HomePage') active @endif" href="{{route('admin.homepage')}}">
            <i class="fas fa-cogs text-primary"></i>Home Page
        </a>
    </div>
    @endcan

    @can('view.user')
    <div class="dropdown">
        <a class="drop-sub @if(@$subMenu == 'Testimonials') active @endif" href="{{route('admin.testimonial')}}">
            <i class="fas fa-quote-left text-primary"></i>Testimonials
        </a>
    </div>
    @endcan
    @can('view.user')
    <div class="dropdown">
        <a class="drop-sub @if(@$subMenu == 'partners') active @endif" href="{{route('admin.partner')}}">
            <i class="fas fa-handshake text-primary"></i>
Partners
        </a>
    </div>
    @endcan

</div>
