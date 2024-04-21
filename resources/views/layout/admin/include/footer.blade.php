<footer class="footer-sticky">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 p-0">
                @include('layout.admin.include.breadcrumb')
            </div>
            <div class="col-md-4 text-center">
                <ul class="footer-list">
                    <li>
                        {{ @$viewComposerSiteSetting->company_name ?? '' }}
                    </li>
                </ul>
            </div>
            <div class="col-md-4 text-right">
                <ul class="footer-list">
                    {{date('l, F d, Y')}}
                    <li id="footertimer"></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
