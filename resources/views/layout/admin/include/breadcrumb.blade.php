<div class="footer-content">
    <div class="breadcrumb-wrapper">
        <ul>
            <li>
                <a href="{{route('admin.dashboard')}}">Dashboard</a>
            </li>
            @if(isset($breadCrumbs) && !empty($breadCrumbs))
                @foreach($breadCrumbs as $breadCrumb)
                    <li>
                        <a class="active">{{ucfirst($breadCrumb['parent'])}}</a>
                    </li>
                    <li>
                        <a href="{{$breadCrumb['url']}}">{{ucfirst($breadCrumb['child'])}}</a>
                    </li>
                    @if(isset($breadCrumb['subChild']) && $breadCrumb['subChild'] != '')
                        <li>
                            <a class="active">{{ucfirst($breadCrumb['subChild'])}}</a>
                        </li>
                        @endif
                @endforeach
            @endif
        </ul>
    </div>
</div>