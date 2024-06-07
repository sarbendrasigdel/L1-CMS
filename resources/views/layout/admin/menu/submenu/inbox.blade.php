@can('view.user')
    <div class="dropdown">
        <a class="drop-sub @if(@$subMenu == 'inbox') active @endif" href="{{route('admin.mails')}}">
            <i class="fas fa-quote-left text-primary"></i>Inbox
        </a>
    </div>
    @endcan