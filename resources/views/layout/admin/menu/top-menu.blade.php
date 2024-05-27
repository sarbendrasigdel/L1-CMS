<div class="nav-action-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 d-md-none d-lg-none d-block">
                <div class="menu-respo">
                    <img src="{{asset('assets/admin/images/menu.svg')}}" alt="">
                </div>
            </div>
            <div class="col-md-6 col-6 text-right text-md-left">
                <div class="soft-brand-image">
                   {{-- <img src="{{asset('assets/admin')}}/images/logo.png" alt=""> --}}
                </div>
            </div>
            <div class="col-md-6 col-3 text-md-right">
                <div class="helper-panel-top">
                    @include('layout.admin.menu.user.logout')
                </div>
                <div class="respo-mnu-tp d-inline-block d-md-none">
                    <span class="d-inline-block d-md-none"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span>

                </div>
            </div>
        </div>
    </div>
</div>
