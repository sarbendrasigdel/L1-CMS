<section class="nav-menu-tab nav-header-top">
    <div class="container-fluid">
        @include('layout.admin.menu.main-menu')
        <div class="row">
            <div class="col-lg-12 p-0">
                <div class="nav-tab-cnt">
                    <div class="tab-content" id="myTabContent">
                        @include('layout.admin.menu.submenu.dashboard')
                        @include('layout.admin.menu.submenu.setting')
                        @include('layout.admin.menu.submenu.users')
                        @include('layout.admin.menu.submenu.pagesetting')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
