<div class="tab-pane fade @if(@$menu == 'pagesetting') active show @endif" id="pagesetting" role="tabpanel" aria-labelledby="register-tab">

    @php $loggedInUser = \Illuminate\Support\Facades\Auth::guard('admin-user')->user() @endphp

    @can('view.user.role')

    <div class="dropdown">
        <a class="drop-sub @if(@$subMenu == 'Home page') active @endif" href="{{route('admin.homepage')}}">
            <i class="fas fa-cogs text-primary"></i>Home Page
        </a>
    </div>

    @endcan

    @can('view.user.designation')
    <div class="dropdown">
        <a class="drop-sub @if(@$subMenu == 'portfolio') active @endif" href="{{route('admin.designations')}}">
            <i class="fas fa-id-badge text-primary"></i>Portfolio
        </a>
    </div>
    @endcan

    @can('view.user')
    <div class="dropdown">
        <a class="drop-sub @if(@$subMenu == 'category') active @endif" href="{{route('admin.category')}}">
            <i class="fa fa-tag text-primary"></i>category
        </a>
    </div>
    @endcan
    @can('view.user')
    <div class="dropdown">
        <a class="drop-sub @if(@$subMenu == 'Services') active @endif" href="{{route('admin.users')}}">
            <i class="fas fa-user-plus text-primary"></i>Services
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
