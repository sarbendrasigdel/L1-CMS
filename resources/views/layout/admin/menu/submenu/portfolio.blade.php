<div class="tab-pane fade @if(@$menu == 'portfolio') active show @endif" id="portfolio" role="tabpanel" aria-labelledby="portfolio-tab">

    @php $loggedInUser = \Illuminate\Support\Facades\Auth::guard('admin-user')->user() @endphp

  
    @can('view.user')
    <div class="dropdown">
        <a class="drop-sub @if(@$subMenu == 'Portfolio') active @endif" href="{{route('admin.portfolio')}}">
            <i class="fas fa-id-badge text-primary"></i>Portfolio
        </a>
    </div>
    @endcan

    @can('view.user')
    <div class="dropdown">
        <a class="drop-sub @if(@$subMenu == 'Portfolio Image') active @endif" href="{{route('admin.portfolio-image')}}">
            <i class="fa fa-tag text-primary"></i>Portfolio Image
        </a>
    </div>
    @endcan
   

</div>
