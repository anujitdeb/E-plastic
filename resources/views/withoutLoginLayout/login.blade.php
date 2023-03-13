@extends('../withoutLoginLayout/base')

@section('body')
    <body class="main">
        <div class="login">
            @yield('content')
            @include('../withoutLoginLayout/components/dark-mode-switcher')
            {{--        @include('../withoutLoginLayout/components/main-color-switcher')--}}

            <!-- BEGIN: JS Assets-->
            <script src="{{ mix('dist/js/app.js') }}"></script>
            <!-- END: JS Assets-->

            @yield('script')
        </div>
    </body>
@endsection
