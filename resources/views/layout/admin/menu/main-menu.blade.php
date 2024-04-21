<div class="row">
    <div class="col-lg-12 p-0">
        <div class="main-nav-menu">
            <button class="btn btn-close-nav-phone d-md-none d-lg-none d-block">
                ×
            </button>
            <ul class="nav nav-tabs responsive-tabs" id="myTab" role="tablist">

                <li class="nav-item">
                    <a class="nav-link @if(@$menu == 'dashboard') active @endif" id="dashboard-tab" data-toggle="tab"
                       href="#dashboard" role="tab"
                       aria-controls="dashboard" aria-selected="false"><i class="fas fa-home text-success"></i>Dashboard</a>
                </li>

                @php $loggedInUser = \Illuminate\Support\Facades\Auth::guard('admin-user')->user(); @endphp
                @if($loggedInUser->can('view.settings'))

                    <li class="nav-item">
                        <a class="nav-link @if(@$menu == 'Setting') active @endif" href="#setting"
                           id="setting-tab"
                           data-toggle="tab"><i class="fa fa-cogs text-success"></i>Setting</a>
                    </li>
                @endif

                @if($loggedInUser->can('view.user.role') || $loggedInUser->can('view.user.designation') || $loggedInUser->can('view.user'))

                    <li class="nav-item">
                        <a class="nav-link @if(@$menu == 'users') active @endif" id="register-tab" data-toggle="tab"
                           href="#register" role="tab"
                           aria-controls="contact" aria-selected="false"><i class="fas fa-users text-success"></i> User</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
