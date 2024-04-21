@if(Session::has('portalSwitched'))
    <div class="logout-wrap" style="display:inline-block; margin-right: 18px ; vertical-align: middle ">
        <a style="color: #fff" href="{{route('admin.check.user.portal.login', Session::get('portalSwitched')['id'])}}">Back
            To Portal<i class="fas fa-sign-out-alt"></i></a>
    </div>
@endif
<div class="user-auth-info user-auth-info-ys">
    <div class="user-auth-info-txt">
        <div class="dropdown">
            <span class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                Welcome, {{auth()->guard('admin-user')->user()->latestAdminUserInfo->full_name}} <i class="fas fa-user"></i>
            </span>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item text-dark" href="{{route('admin.admin-pw-change')}}">Change Password</a>
            </div>
        </div>
    </div>

    <div class="user-auth-info-txt">
        <a href="{{route('admin.logout')}}">Logout <i class="fas fa-sign-out-alt"></i></a>

    </div>

</div>
