<style>

    .app-spin-spinning {
        position: static;
        display: inline-block;
        opacity: 1;
    }

    .app-spin-nested-loading {
        position: relative;
    }

    .app-spin-nested-loading > div > .app-spin {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 4;
        display: block;
        width: 100%;
        height: 100%;
        max-height: 400px;
    }

    .app-spin-nested-loading > div > .app-spin .app-spin-dot {
        position: absolute;
        top: 50%;
        left: 50%;
        margin: -10px;
    }

    .app-spin-nested-loading > div > .app-spin .app-spin-text {
        position: absolute;
        top: 50%;
        width: 100%;
        padding-top: 5px;
        text-shadow: 0 1px 2px #fff;
    }

    .app-spin-nested-loading > div > .app-spin.app-spin-show-text .app-spin-dot {
        margin-top: -20px;
    }

    .app-spin-nested-loading > div > .app-spin-sm .app-spin-dot {
        margin: -7px;
    }

    .app-spin-nested-loading > div > .app-spin-sm .app-spin-text {
        padding-top: 2px;
    }

    .app-spin-nested-loading > div > .app-spin-sm.app-spin-show-text .app-spin-dot {
        margin-top: -17px;
    }

    .app-spin-nested-loading > div > .app-spin-lg .app-spin-dot {
        margin: -16px;
    }

    .app-spin-nested-loading > div > .app-spin-lg .app-spin-text {
        padding-top: 11px;
    }

    .app-spin-nested-loading > div > .app-spin-lg.app-spin-show-text .app-spin-dot {
        margin-top: -26px;
    }

    .app-spin-container {
        position: relative;
        -webkit-transition: opacity 0.3s;
        transition: opacity 0.3s;
    }

    .app-spin-container::after {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 10;
        display: none \9;
        width: 100%;
        height: 100%;
        background: #fff;
        opacity: 0;
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
        content: '';
        pointer-events: none;
    }

    .app-spin-blur {
        clear: both;
        overflow: hidden;
        opacity: 0.5;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        pointer-events: none;
    }

    .app-spin-blur::after {
        opacity: 0.4;
        pointer-events: auto;
    }

    .app-spin-tip {
        color: rgba(0, 0, 0, 0.45);
    }

    .app-spin-dot {
        position: relative;
        display: inline-block;
        font-size: 20px;
        width: 1em;
        height: 1em;
    }

    .app-spin-dot-item {
        position: absolute;
        display: block;
        width: 9px;
        height: 9px;
        background-color: #1890ff;
        border-radius: 100%;
        -webkit-transform: scale(0.75);
        transform: scale(0.75);
        -webkit-transform-origin: 50% 50%;
        transform-origin: 50% 50%;
        opacity: 0.3;
        -webkit-animation: appSpinMove 1s infinite linear alternate;
        animation: appSpinMove 1s infinite linear alternate;
    }

    .app-spin-dot-item:nth-child(1) {
        top: 0;
        left: 0;
    }

    .app-spin-dot-item:nth-child(2) {
        top: 0;
        right: 0;
        -webkit-animation-delay: 0.4s;
        animation-delay: 0.4s;
    }

    .app-spin-dot-item:nth-child(3) {
        right: 0;
        bottom: 0;
        -webkit-animation-delay: 0.8s;
        animation-delay: 0.8s;
    }

    .app-spin-dot-item:nth-child(4) {
        bottom: 0;
        left: 0;
        -webkit-animation-delay: 1.2s;
        animation-delay: 1.2s;
    }

    .app-spin-dot-spin {
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
        -webkit-animation: appRotate 1.2s infinite linear;
        animation: appRotate 1.2s infinite linear;
    }

    .app-spin-rtl .app-spin-dot-spin {
        -webkit-transform: rotate(-45deg);
        transform: rotate(-45deg);
        -webkit-animation-name: appRotateRtl;
        animation-name: appRotateRtl;
    }

    .app-spin-sm .app-spin-dot {
        font-size: 14px;
    }

    .app-spin-sm .app-spin-dot i {
        width: 6px;
        height: 6px;
    }

    .app-spin-lg .app-spin-dot {
        font-size: 32px;
    }

    .app-spin-lg .app-spin-dot i {
        width: 14px;
        height: 14px;
    }

    .app-spin.app-spin-show-text .app-spin-text {
        display: block;
    }

    .app-spin-blur {
        background: #fff;
        opacity: 0.5;
    }

    @-webkit-keyframes appSpinMove {
        to {
            opacity: 1;
        }
    }

    @keyframes appSpinMove {
        to {
            opacity: 1;
        }
    }

    @-webkit-keyframes appRotate {
        to {
            -webkit-transform: rotate(405deg);
            transform: rotate(405deg);
        }
    }

    @keyframes appRotate {
        to {
            -webkit-transform: rotate(405deg);
            transform: rotate(405deg);
        }
    }

    @-webkit-keyframes appRotateRtl {
        to {
            -webkit-transform: rotate(-405deg);
            transform: rotate(-405deg);
        }
    }

    @keyframes appRotateRtl {
        to {
            -webkit-transform: rotate(-405deg);
            transform: rotate(-405deg);
        }
    }
</style>
<div class="loader-container" style="display: none;">
    <div class="loader-content">

        <div class="app-spin app-spin-spinning app-spin-show-text"><span class="app-spin-dot app-spin-dot-spin"><i
                    class="app-spin-dot-item"></i><i class="app-spin-dot-item"></i><i class="app-spin-dot-item"></i><i
                    class="app-spin-dot-item"></i></span>
            <div class="app-spin-text">Loading...</div>
        </div>
    </div>
</div>
