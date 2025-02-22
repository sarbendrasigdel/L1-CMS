<div class="tab-pane fade @if(@$menu == 'otherpages') active show @endif" id="otherpages" role="tabpanel" aria-labelledby="otherpages-tab">

    @php $loggedInUser = \Illuminate\Support\Facades\Auth::guard('admin-user')->user() @endphp


    @can('view.user')
    <div class="dropdown">
        <a class="drop-sub @if(@$subMenu == 'Team') active @endif" href="{{route('admin.teams')}}">
            <i class="fas fa-user-plus text-primary"></i>Team
        </a>
    </div>
    @endcan
    @can('view.user')
    <div class="dropdown">
        <a class="drop-sub @if(@$subMenu == 'Blog') active @endif" href="{{route('admin.blogs')}}">
            <i class="fas fa-newspaper text-primary"></i>Blog
        </a>
    </div>
    @endcan

</div>
