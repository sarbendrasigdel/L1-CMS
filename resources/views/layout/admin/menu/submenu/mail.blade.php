<div class="tab-pane fade @if(@$menu == 'Mails') active show @endif" id="mails" role="tabpanel" aria-labelledby="mails-tab">
@can('view.user')
    <div class="dropdown">
        <a class="drop-sub @if(@$subMenu == 'inbox') active @endif" href="{{route('admin.mails')}}">
            <i class="fas fa-inbox"></i>Inbox
        </a>
    </div>
    @endcan
</div>