{{--<style>--}}
{{--    .action-spin {--}}
{{--        height: 100px;--}}
{{--        width: 100px;--}}
{{--        position: absolute;--}}
{{--        top: 50%;--}}
{{--        left: 50%;--}}
{{--        transform: translate(-50%, -50%);--}}
{{--    }--}}

{{--</style>--}}
{{--<div class="modal-spinner" style="display: none;">--}}
{{--    <img class="action-spin" src="{{asset('assets/admin/images/modal-spinner.svg')}}">--}}
{{--</div>--}}

<style>

    .loader-main {
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        background: rgba(255,255,255,.3);
        display: flex;
        backdrop-filter: blur(2px);
        align-items: center;
        justify-content: center;
        z-index: 100;
        flex-direction: column;
        position: fixed;
    }
    .loader-main-asset img {
        width: 90px;
        height: 90px;
    }

</style>


<div class="loader-main loader-in-body modal-spinner"  style="display: none;">
    <div class="loader-main-asset">
        <img src="{{asset('assets/admin/images/modal-spinner.svg')}}" alt="">
    </div>
    <p>Please have a patience ...</p>
</div>
