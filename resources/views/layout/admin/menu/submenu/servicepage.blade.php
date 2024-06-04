<div class="tab-pane fade @if(@$menu == 'servicepage') active show @endif" id="servicepage" role="tabpanel" aria-labelledby="servicepage-tab">

    @php $loggedInUser = \Illuminate\Support\Facades\Auth::guard('admin-user')->user() @endphp

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
        <a class="drop-sub @if(@$subMenu == 'Service Features') active @endif" href="{{route('admin.serviceFeatures')}}">
            <i class="fas fa-user-plus text-primary"></i>Service Features
        </a>
    </div>
    @endcan

</div>
