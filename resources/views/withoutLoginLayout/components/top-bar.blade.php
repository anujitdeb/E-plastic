<!-- BEGIN: Top Bar -->
<div class="top-bar-boxed h-[70px] z-[51] relative border-b border-white/[0.08] -mt-7 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 md:pt-0 mb-12">
    <div class="h-full flex items-center">
        <!-- BEGIN: Logo -->
        <a href="" class="-intro-x hidden md:flex">
            @if($setting->logo)
            <img alt="{{$setting->site_name}}" class="w-6" src="{{ asset('uploads/logo/'.$setting->logo) }}">
            @else
            <img alt="{{$setting->site_name}}" class="w-6" src="{{ asset('dist/images/eplastic-logo.png') }}">
            @endif

                <span class="text-white text-lg ml-3"> E<span class="font-medium">plastic</span> </span>
        </a>
        <!-- END: Logo -->
        <!-- BEGIN: Breadcrumb -->
        <nav aria-label="breadcrumb" class="-intro-x h-full mr-auto">
            {{--<ol class="breadcrumb breadcrumb-light">
                <li class="breadcrumb-item"><a href="">Application</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{session('page')}}</li>
            </ol>--}}
        </nav>

        <a href="{{route('dashboard.login')}}" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top mr-2 text-white">Login</a>

        <a href="{{route('registration')}}" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top text-white">Register</a>

        <!-- END: Breadcrumb -->
        <!-- BEGIN: Search -->
       {{-- <div class="intro-x relative mr-3 sm:mr-6">
            <div class="search hidden sm:block">
                <input type="text" class="search__input form-control border-transparent" placeholder="Search...">
                <i data-feather="search" class="search__icon dark:text-slate-500"></i>
            </div>
            <a class="notification notification--light sm:hidden" href="">
                <i data-feather="search" class="notification__icon dark:text-slate-500"></i>
            </a>

        </div>--}}
        <!-- END: Search -->
       {{-- <!-- BEGIN: Notifications -->
        <div class="intro-x dropdown mr-4 sm:mr-6">
            <div class="dropdown-toggle notification notification--bullet cursor-pointer" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                <i data-feather="bell" class="notification__icon dark:text-slate-500"></i>
            </div>
            <div class="notification-content pt-2 dropdown-menu">
                <div class="notification-content__box dropdown-content">
                    <div class="notification-content__title">Notifications</div>
                    @foreach (array_slice($fakers, 0, 5) as $key => $faker)
                        <div class="cursor-pointer relative flex items-center {{ $key ? 'mt-5' : '' }}">
                            <div class="w-12 h-12 flex-none image-fit mr-1">
                                <img alt="Icewall Tailwind HTML Admin Template" class="rounded-full" src="{{ asset('dist/images/' . $faker['photos'][0]) }}">
                                <div class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                            </div>
                            <div class="ml-2 overflow-hidden">
                                <div class="flex items-center">
                                    <a href="javascript:;" class="font-medium truncate mr-5">{{ $faker['users'][0]['name'] }}</a>
                                    <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">{{ $faker['times'][0] }}</div>
                                </div>
                                <div class="w-full truncate text-slate-500 mt-0.5">{{ $faker['news'][0]['short_content'] }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- END: Notifications -->--}}
        <!-- BEGIN: Account Menu -->
        {{--@php

        if(auth('admin')->check()) {
            $currentUser = auth('admin')->user();
            $type = 'Admin';
        }
        elseif(auth('web')->check()) {
            $currentUser = auth('web')->user();
            $type = 'User';
        }
        elseif(auth('organizer')->check()) {
            $currentUser = auth('organizer')->user();
            $type = 'Organizer';
        }
        elseif(auth('stall')->check()) {
            $currentUser = auth('stall')->user();
            $type = 'Book Stall Owner';
        }
        elseif(auth('buyer')->check()){
            $currentUser = auth('buyer')->user();
            $type = 'buyer';
        }



        @endphp--}}

        {{--<div class="intro-x dropdown w-8 h-8">
            <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                --}}{{--@if(auth('web')->check())
                    <img alt="" src="{{asset('/images/bookStall/'.auth('web')->user()->image)}}">
                @elseif(auth('admin')->check())
                    @if(auth('admin')->user()->image)
                        <img alt="" src="{{ url('uploads/admins/'.auth('admin')->user()->image)}}">
                    @else
                        <img alt="" src="https://images.pexels.com/photos/771742/pexels-photo-771742.jpeg">
                    @endif


                @endif--}}{{--

            </div>
            <div class="dropdown-menu w-56">
                <ul class="dropdown-content bg-primary/80 before:block before:absolute before:bg-black before:inset-0 before:rounded-md before:z-[-1] text-white">
                    <li class="p-2">
                        <div class="font-medium">  <h2 class="text-white"> --}}{{--{{$currentUser->name}}--}}{{--</h2></div>
                        <div class="text-xs text-white/60 mt-0.5 dark:text-slate-500">
                            --}}{{--@foreach ($currentUser->roles as $role)
                               {{$role->name}}
                            @endforeach--}}{{--
                        </div>
                    </li>
                    <li><hr class="dropdown-divider border-white/[0.08]"></li>
                    <li>
                        <a href="{{route('dashboard.profile.index')}}" class="dropdown-item hover:bg-white/5">
                            <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile
                        </a>
                    </li>
                    <li>
                        <a href="{{route('dashboard.profile.changePassword')}}" class="dropdown-item hover:bg-white/5">
                            <i data-feather="lock" class="w-4 h-4 mr-2"></i> Reset Password
                        </a>
                    </li>
                    <li>
                        <a href="" class="dropdown-item hover:bg-white/5">
                            <i data-feather="help-circle" class="w-4 h-4 mr-2"></i> Help
                        </a>
                    </li>
                    <li><hr class="dropdown-divider border-white/[0.08]"></li>
                    <li>
                        @if(auth('web')->check())
                            <a href="{{ route('logout') }}" class="dropdown-item hover:bg-white/5">
                                <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout
                            </a>
                        @elseif(auth('admin')->check())
                            <a href="{{ route('dashboard.logout') }}" class="dropdown-item hover:bg-white/5">
                                <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout
                            </a>
                        @elseif(auth('organizer')->check())
                            <a href="{{ route('organizer.logout') }}" class="dropdown-item hover:bg-white/5">
                                <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout
                            </a>
                        @elseif(auth('stall')->check())
                            <a href="{{ route('stall.logout') }}" class="dropdown-item hover:bg-white/5">
                                <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout
                            </a>
                        @elseif(auth('buyer')->check())
                            <a href="{{ route('buyer.logout') }}" class="dropdown-item hover:bg-white/5">
                                <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout
                            </a>

                        @endif

                    </li>
                </ul>
            </div>
        </div>--}}
        <!-- END: Account Menu -->
    </div>
</div>
<!-- END: Top Bar -->
