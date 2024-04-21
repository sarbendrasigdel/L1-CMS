@extends('layout.frontend.master-layout')
@section('additional-css')
    <style>
        .flex-middle {
            display: block;
        }

        .flex-middle {
            flex: 1;
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
        }

        .error-content-wrap {
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            padding: 50px 0;
        }

        .err-illustrator img {
            width: 250px;
            height: 250px;
            margin: 0 auto 12px;
            object-fit: contain;
        }

        .page-header h3 {
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 20px;
            border-bottom: 2px solid #D8002D;
            padding-bottom: 20px;
        }

        .tem-bg-pad {
            padding: 140px 0;
        }

        @media (max-width: 767px) {
            .tem-bg-pad {
                padding: 50px 0;
            }

            .page-header h3 {
                font-size: 20px;
            }
        }
    </style>
@endsection
@section('main-content')
    <div class="temple-bg tem-bg-pad">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="error-content-wrap">
                        <div class="er-content-wrap">
                            <div class="er-txt">
                                <div class="page-header">
                                    <h3 class="color-white font-primary">
                                        ERROR 403, Forbidden
                                    </h3>
                                    <p class="c-mb-40">
                                        Access is forbidden to the requested page.
                                    </p>
                                    <a href="{{route('frontend.index')}}"
                                       class="btn btn--primary">
                                        TAKE ME HOME
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('additional-js')

@endsection
