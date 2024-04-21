<div class="tab-pane fade @if(@$menu == 'users') active show @endif" id="register" role="tabpanel" aria-labelledby="register-tab">

    @php $loggedInUser = \Illuminate\Support\Facades\Auth::guard('admin-user')->user() @endphp

    @can('view.user.role')

    <div class="dropdown">
        <a class="drop-sub @if(@$subMenu == 'roles') active @endif" href="{{route('admin.roles')}}">
            <i class="fas fa-cogs text-primary"></i>Role Management
        </a>
    </div>

    @endcan

    @can('view.user.designation')
    <div class="dropdown">
        <a class="drop-sub @if(@$subMenu == 'designations') active @endif" href="{{route('admin.designations')}}">
            <i class="fas fa-id-badge text-primary"></i>Designations
        </a>
    </div>
    @endcan

    @can('view.user')
    <div class="dropdown">
        <a class="drop-sub @if(@$subMenu == 'users') active @endif" href="{{route('admin.users')}}">
            <i class="fas fa-user-plus text-primary"></i>User Management
        </a>
    </div>
    @endcan

</div>
