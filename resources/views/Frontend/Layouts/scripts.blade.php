    <!-- jQuery js -->
    <script src="{{asset('Frontend/js/plugins/jquery.min.js')}}"></script>
    <!-- swup js -->
    <script src="{{asset('Frontend/js/plugins/swup.min.js')}}"></script>
    <!-- swiper js -->
    <script src="{{asset('Frontend/js/plugins/swiper.min.js')}}"></script>
    <!-- fancybox js -->
    <script src="{{asset('Frontend/js/plugins/fancybox.min.js')}}"></script>
    <!-- gsap js -->
    <script src="{{asset('Frontend/js/plugins/gsap.min.js')}}"></script>
    <!-- scroll smoother -->
    <script src="{{asset('Frontend/js/plugins/smooth-scroll.js')}}"></script>
    <!-- scroll trigger js -->
    <script src="{{asset('Frontend/js/plugins/ScrollTrigger.min.js')}}"></script>
    <!-- scroll to js -->
    <script src="{{asset('Frontend/js/plugins/ScrollTo.min.js')}}"></script>
    <!-- ashley js -->
    <script src="{{asset('Frontend/js/main.js')}}"></script>
    <!--admin-->
    <script src="{{ asset('assets/admin/js/custom.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <script src="{{asset('Frontend/custom/js/frontend.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
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