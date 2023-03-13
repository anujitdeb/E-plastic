@extends('../layout/base')

@section('body')
    <body class="main">
        <div class="login">
            @yield('content')
            @include('../layout/components/dark-mode-switcher')
            {{--        @include('../layout/components/main-color-switcher')--}}

            <!-- BEGIN: JS Assets-->
            <script src="{{ mix('dist/js/app.js') }}"></script>
            <!-- END: JS Assets-->

            @yield('script')
        </div>
    </body>
@endsection
