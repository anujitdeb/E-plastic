@extends('../withoutLoginLayout/base')

@section('body')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Mono&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@600&display=swap');

        @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@500&display=swap');
        *{
            font-family: 'IBM Plex Mono', monospace;
        }

         ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
             color: #a2a4a1 !important;
                opacity: .5; /* Firefox */

         }

        :-ms-input-placeholder { /* Internet Explorer 10-11 */
            color: red!important;
        }

        ::-ms-input-placeholder { /* Microsoft Edge */
            color: red!important;
        }

        @if(!isset($dark_mode))
            @php
                $dark_mode = false;
            @endphp
        @endif
        @if($dark_mode)
              .dataTables_length  >* {

                    color: #fff!important;
                }
                .dataTables_filter >* {
                    color: #fff!important;
                }
                .dataTables_info  {
                    color: #fff!important;
                }
                .dataTables_paginate  {
                    color: #fff!important;
                }
        }

        @endif

    </style>
    <body class="main">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })


    </script>



        @yield('content')
       {{-- @include('../withoutLoginLayout/components/dark-mode-switcher')
        @include('../withoutLoginLayout/components/main-color-switcher')--}}

        <!-- BEGIN: JS Assets-->

        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        {{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBG7gNHAhDzgYmq4-EHvM4bqW1DNj2UCuk&libraries=places"></script>
--}}
        <script src="{{ mix('dist/js/app.js') }}"></script>
        <!-- END: JS Assets-->
        <!-- BEGIN: Modal Content -->
        <div id="programmatically-modal" class="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl p-2">
                <div class="modal-content p-8" id="modalContent">

                </div>
            </div>
        </div>
        <!-- END: Modal Content -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        @yield('script')
    </body>
@endsection
