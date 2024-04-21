<script src="{{asset('assets/admin/js/jquery-3.3.1.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{asset('assets/admin/js/popper.js')}}"></script>
<script src="{{asset('assets/admin/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/admin/js/bootstrap-datetime/moment.min.js')}}"></script>
<script src="{{asset('assets/admin/js/bootstrap-datetime/bootstrap-datetimepicker.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="{{asset('assets/plugin/ckeditor/ckeditor.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="{{ asset('assets/admin/js/custom.js')}}"></script>
<script>
    $(document).ready(function () {
        $('input').keypress(function (event) {
            if (event.which == 13) {
                event.preventDefault();
                return false;
            }
        });
        $(document).on('keydown', function (event) {
            if (event.which == 13) {
                event.preventDefault();
                return false;
            }
        });
    });

</script>

<script>
    var countDownDate = {{date('H')}} * 60 * 60 * 1000 + {{date('i')}} * 60 * 1000 + {{date('s')}} * 1000;
    var x = setInterval(function () {
        var distance = countDownDate + 1000;
        countDownDate = distance;
        var hours = Math.floor(distance / (1000 * 60 * 60));
        var min = distance - (hours * (1000 * 60 * 60));
        var minutes = Math.floor(min / (1000 * 60));
        var sec = min - (minutes * (1000 * 60));
        var seconds = Math.floor(sec / 1000);
        var ampm = hours >= 12 ? 'PM' : 'AM';
        if (hours > 12) {
            hours = hours - 12;

        }
        if (hours < 10) {
            hours = '0' + hours;
        }
        if (minutes < 10) {
            minutes = '0' + minutes;
        }
        if (seconds < 10) {
            seconds = '0' + seconds;
        }
        document.getElementById("footertimer").innerHTML = hours + " : "
            + minutes + " : " + seconds + " " + ampm;

    }, 1000);
</script>
