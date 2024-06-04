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
                {{-- @if($loggedInUser->can('view.user') || $loggedInUser->can('view.user') || $loggedInUser->can('view.user'))
                
                    <li class="nav-item">
                        <a class="nav-link @if(@$menu == 'pagesetting') active @endif" id="pagesetting-tab" data-toggle="tab"
                           href="#pagesetting" role="tab"
                           aria-controls="pagesetting" aria-selected="false"><i class="fas fa-users text-success"></i> Page Settings</a>
                    </li>
                @endif --}}
                @if($loggedInUser->can('view.user') || $loggedInUser->can('view.user') || $loggedInUser->can('view.user'))
                
                    <li class="nav-item">
                        <a class="nav-link @if(@$menu == 'homepage') active @endif" id="homepage-tab" data-toggle="tab"
                           href="#homepage" role="tab"
                           aria-controls="homepage" aria-selected="false"><i class="fas fa-users text-success"></i> Home Page</a>
                    </li>
                @endif
                @if($loggedInUser->can('view.user') || $loggedInUser->can('view.user') || $loggedInUser->can('view.user'))
                
                    <li class="nav-item">
                        <a class="nav-link @if(@$menu == 'servicepage') active @endif" id="servicepage-tab" data-toggle="tab"
                           href="#servicepage" role="tab"
                           aria-controls="servicepage" aria-selected="false"><i class="fas fa-users text-success"></i> service Page</a>
                    </li>
                @endif
                @if($loggedInUser->can('view.user') || $loggedInUser->can('view.user') || $loggedInUser->can('view.user'))
                
                    <li class="nav-item">
                        <a class="nav-link @if(@$menu == 'portfolio') active @endif" id="portfolio-tab" data-toggle="tab"
                           href="#portfolio" role="tab"
                           aria-controls="portfolio" aria-selected="false"><i class="fas fa-users text-success"></i> Portfolio Page</a>
                    </li>
                @endif
                @if($loggedInUser->can('view.user') || $loggedInUser->can('view.user') || $loggedInUser->can('view.user'))
                
                    <li class="nav-item">
                        <a class="nav-link @if(@$menu == 'otherpages') active @endif" id="otherpages-tab" data-toggle="tab"
                           href="#otherpages" role="tab"
                           aria-controls="otherpages" aria-selected="false"><i class="fas fa-users text-success"></i> Other Pages</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
