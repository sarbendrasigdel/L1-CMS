<div class="tab-pane fade @if(@$menu == 'pagesetting') active show @endif" id="pagesetting" role="tabpanel" aria-labelledby="pagesetting-tab">

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
        <a class="drop-sub @if(@$subMenu == 'portfolio') active @endif" href="{{route('admin.designations')}}">
            <i class="fas fa-id-badge text-primary"></i>Portfolio
        </a>
    </div>
    @endcan

    @can('view.user')
    <div class="dropdown">
        <a class="drop-sub @if(@$subMenu == 'Category') active @endif" href="{{route('admin.category')}}">
            <i class="fa fa-tag text-primary"></i>Category
        </a>
    </div>
    @endcan
    @can('view.user')
    <div class="dropdown">
        <a class="drop-sub @if(@$subMenu == 'Services') active @endif" href="{{route('admin.services')}}">
            <i class="fas fa-user-plus text-primary"></i>Services
        </a>
    </div>
    @endcan
    @can('view.user')
    <div class="dropdown">
        <a class="drop-sub @if(@$subMenu == 'ServiceFeatures') active @endif" href="{{route('admin.serviceFeatures')}}">
            <i class="fas fa-user-plus text-primary"></i>Service Features
        </a>
    </div>
    @endcan
    @can('view.user')
    <div class="dropdown">
        <a class="drop-sub @if(@$subMenu == 'Team') active @endif" href="{{route('admin.teams')}}">
            <i class="fas fa-user-plus text-primary"></i>Team
        </a>
    </div>
    @endcan
    @can('view.user')
    <div class="dropdown">
        <a class="drop-sub @if(@$subMenu == 'Newsletter') active @endif" href="{{route('admin.users')}}">
            <i class="fas fa-newspaper text-primary"></i>Newsletter
        </a>
    </div>
    @endcan

</div>
