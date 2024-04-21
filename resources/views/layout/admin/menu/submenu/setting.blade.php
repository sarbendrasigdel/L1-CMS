<div class="tab-pane fade @if(@$menu == 'Setting') active show @endif" id="setting" role="tabpanel"
     aria-labelledby="setting-tab">
    @can('view.site.setting')
        <div class="dropdown">
            <a class="drop-sub @if(@$subMenu == 'Site Information') active @endif"
               href="{{route('admin.site-settings')}}">
                <i class="fa fa-cogs text-primary"></i> Site Information
            </a>
        </div>
    @endcan
    @can('view.seoSetting')
        <div class="dropdown">
            <a class="drop-sub @if(@$subMenu == 'Seo Setting') active @endif"
               href="{{route('admin.seoSetting')}}">
                <i class="fa fa-cogs text-primary"></i> Seo Setting
            </a>
        </div>
    @endcan
    @can('view.termsAndCondition')
        <div class="dropdown">
            <a class="drop-sub @if(@$subMenu == 'Terms And Condition') active @endif"
               href="{{route('admin.termsAndCondition')}}">
                <i class="fa fa-cogs text-primary"></i> Terms And Condition
            </a>
        </div>
    @endcan

    @can('view.privacyPolicy')
        <div class="dropdown">
            <a class="drop-sub @if(@$subMenu == 'Privacy Policy') active @endif"
               href="{{route('admin.privacyPolicy')}}">
                <i class="fa fa-cogs text-primary"></i> Privacy Policy
            </a>
        </div>
    @endcan

</div>
