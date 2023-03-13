
@extends('layout.login')
@section('head')
    <title>Login - Admin Panel</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Mono&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@600&display=swap');

        @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@500&display=swap');
        *{
            font-family: 'IBM Plex Mono', monospace;
        }
    </style>
@endsection

@section('content')
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="/eplastic" class="-intro-x flex items-center pt-5">
                    <img alt="Icewall Tailwind HTML Admin Template" class="w-6" src="{{ asset('dist/images/eplastic-logo.png') }}">

                    <span class="text-white text-lg ml-3"> E<span class="font-medium">plastic</span> </span>
                </a>
                <div class="my-auto">
                    <img alt="Icewall Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="{{ asset('dist/images/plasticBeg.png') }}">
                    {{--<div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">A few more clicks to <br> sign in to your account.</div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Manage all your e-commerce accounts in one place</div>--}}
                </div>
            </div>

            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Registration</h2>

                    {{--@include('login.account_choose')--}}

                    {{--<div class="intro-x mt-2 text-slate-400 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>--}}
                    <div class="intro-x mt-8">
                        <form method="POST" action="{{route('registration.store')}}">
                            @csrf
                            <div class="intro-x mt-8">

                                <label>Type : </label>
                                <select name="type" class="from-control sm:ml-auto mt-3 sm:mt-0 sm:w-auto form-select box my-4" style="cursor: pointer">
                                    <option value="customer">Customer</option>
                                    <option value="employee">Employee</option>
                                    <option value="buyer">Buyer</option>
                                </select>


                                <input type="text" class="@error('name')is-invalid @enderror intro-x login__input form-control py-3 px-4 block" placeholder="Name" id="name" name="name"   />
                                @error('name')<span class="text-danger">{{$message}}</span>@enderror
                                <input type="text" class="@error('phone')is-invalid @enderror intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Phone Number" id="phone" name="phone"   />
                                @error('phone')<span class="text-danger">{{$message}}</span>@enderror
                                <input type="email" class="@error('email')is-invalid @enderror intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Email Address" id="email" name="email"  />
                                @error('email')<span class="text-danger">{{$message}}</span>@enderror
                                <input type="Text" class="@error('address')is-invalid @enderror intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Present Address" id="address" name="address"  />
                                @error('address')<span class="text-danger">{{$message}}</span>@enderror

                                <input type="password" class="@error('password')is-invalid @enderror intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Password" id="password" name="password"  />
                                @error('password')<span class="text-danger">{{$message}}</span>@enderror
                                <input type="password" class="@error('cpassword')is-invalid @enderror intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Confirm Password" id="cpassword" name="cpassword"  />
                                @error('cpassword')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            {{--<div class="intro-x flex text-gray-700 text-xs sm:text-sm mt-4">
                                <div class="flex items-center mr-auto">
                                    <input type="checkbox" class="input border mr-2" id="remember-me">
                                    <label class="cursor-pointer select-none" for="remember-me" name="remember">{{ __('Remember me') }}</label>
                                </div>
                                <a href="">Forgot Password?</a>
                            </div>
                            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                                <button type="submit" class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3">Register</button>
                            </div>--}}


                            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                                <button type="submit" id="btn-login" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Register</button>
                                <a href="{{route('dashboard.login')}}" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Login</a>
                                {{--                        <button class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Register</button>--}}
                            </div>

                        </form>
                    </div>
                    {{--<div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
                        <div class="flex items-center mr-auto">
                            <input id="remember-me" type="checkbox" class="form-check-input border mr-2">
                            <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                        </div>
                        <a href="{{route('dashboard.forgot-password')}}">Forgot Password?</a>
                    </div>--}}
                    {{--<div class="intro-x mt-10 xl:mt-24 text-slate-600 dark:text-slate-500 text-center xl:text-left">
                        By signin up, you agree to our <a class="text-primary dark:text-slate-200" href="">Terms and Conditions</a> & <a class="text-primary dark:text-slate-200" href="">Privacy Policy</a>
                    </div>--}}
                </div>
            </div>
            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if(Session::has('success'))
                <div class="alert alert-outline-success">
                    {{ session('success') }}
                </div>
            @endif
            <!-- END: Login Form -->
        </div>
    </div>
@endsection

@section('script')
    {{--<script>
        (function () {
            async function login() {
                // Reset state
                $('#login-form').find('.login__input').removeClass('border-danger')
                $('#login-form').find('.login__input-error').html('')

                // Post form
                let email = $('#email').val()
                let password = $('#password').val()

                // Loading state
                $('#btn-login').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>')
                tailwind.svgLoader()
                await helper.delay(1500)
                console.log('Loading state')
                axios.post(`{{route('dashboard.loginPost')}}`, {
                    email: email,
                    password: password
                }).then(res => {
                    console.log(res)
                    if (res.data.status === 'success') {
                        window.location.href = `{{route('dashboard.index')}}`
                    } else {
                        $('#btn-login').html('Login')
                        if (res.data.errors) {
                            if (res.data.errors.email) {
                                $('#email').addClass('border-danger')
                                $('#error-email').html(res.data.errors.email)
                            }
                            if (res.data.errors.password) {
                                $('#password').addClass('border-danger')
                                $('#error-password').html(res.data.errors.password)
                            }
                        }
                    }
                }).catch(err => {
                    $('#btn-login').html('Login')
                    //Check if the response is 422
                    if (err.response.data.message != 'Wrong email or password.') {
                        for (const [key, val] of Object.entries(err.response.data.errors)) {
                            $(`#${key}`).addClass('border-danger')
                            $(`#error-${key}`).html(val)


                        }
                    } else {
                        $(`#password`).addClass('border-danger')
                        $(`#error-password`).html(err.response.data.errors)
                    }
                })
            }

            $('#login-form').on('keyup', function(e) {
                if (e.keyCode === 13) {
                    login()
                }
            })

            $('#btn-login').on('click', function() {
                login()
            })
        })()
    </script>--}}
@endsection
