@extends('../layout/' . $layout)

@section('subhead')
    <title>{{$user->name}} - Profile</title>
@endsection
@include('../../layout/components/dark-mode-switcher')
@include('../../layout/components/main-color-switcher')
@section('subcontent')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <div id="listContainer" class="intro-y col-span-12 overflow-auto lg:overflow-visible mt-20">


        {{--    Template Start --}}

        <!-- component -->
        <body class="bg-gray-300 antialiased">
        <div class="container mx-auto my-60">
            <div>

                <div class="bg-white relative shadow rounded-lg w-5/6 md:w-5/6  lg:w-4/6 xl:w-3/6 mx-auto">
                    <div class="flex justify-center">
                        @if($user->image)
                            <img class="rounded-full w-32 h-32 border-4 border-white -mt-16"
                                 src="{{ url('uploads/admins/'.$user->image) }}"
                                 alt="{{$user->name}}">
                        @else
                            <img src="https://images.pexels.com/photos/771742/pexels-photo-771742.jpeg" alt=""
                                 class="rounded-full mx-auto  -top-20 w-32 h-32 shadow-md border-4 border-white transition duration-200 transform hover:scale-110">

                        @endif
                    </div>


                    <button class="btn btn-primary  hover:btn-primary font-bold py-2 px-4 rounded-full absolute right-0 mr-4 mt-4 editElement" value="{{route('dashboard.profile.edit',$user->id)}}">
                        Edit Profile
                    </button>


                    <div class="mt-16">
                        <h1 class="font-bold text-center text-3xl text-gray-900">{{$user->name}}</h1>
                        <br>
                        <p class="text-center text-sm text-gray-400 font-medium">
                            @foreach ($user->roles as $role)
                                <span class=" rounded-full bg-primary text-white px-2 py-1">{{$role->name}}</span>
                            @endforeach</p>
                        <p>
                        <span>




                        </span>
                        </p>

                        <div class="my-5 px-6">
                            <a href="mailto:{{$user->email}}"
                               class="text-gray-200 block rounded-lg text-center font-medium leading-6 px-6 py-3 bg-gray-900 hover:bg-black hover:text-white">Connect
                                with <span class="font-bold">{{$user->email}}</span></a>
                        </div>
                        <div class="flex justify-between items-center my-5 px-6">
                           @if($user->facebook)
                            <a href="{{$user->facebook}}" target="_blank"
                               class="text-gray-500 hover:text-gray-900 hover:bg-gray-100 rounded transition duration-150 ease-in font-medium text-sm text-center w-full py-3 "><i class="fa fa-facebook-square" style="font-size:15px; color: #4267B2" > Facebook</i> </a>
                            @endif
                            @if($user->twitter)
                            <a href="{{$user->twitter}}" target="_blank"
                               class="text-gray-500 hover:text-gray-900 hover:bg-gray-100 rounded transition duration-150 ease-in font-medium text-sm text-center w-full py-3"><i class="fa fa-twitter-square" style="font-size:17px; color: #1DA1F2" > Twitter </i></a>
                               @endif
                            @if($user->instagram)
                            <a href="{{$user->instagram}}" target="_blank"
                               class="text-gray-500 hover:text-gray-900 hover:bg-gray-100 rounded transition duration-150 ease-in font-medium text-sm text-center w-full py-3"> <i class="fa fa-instagram" style="font-size:15px; color: #fe2082 ;" > Instagram </i></a>
                               @endif
                               @if($user->email)
                            <a href="mailto:{{$user->email}}"
                               class="text-gray-500 hover:text-gray-900 hover:bg-gray-100 rounded transition duration-150 ease-in font-medium text-sm text-center w-full py-3"> <i class="fa fa-envelope" style="font-size:15px; color: #ea4335" > Email </i>
                            </a>
                               @endif
                            @if($user->linkedin)
                            <a href="{{$user->linkedin}}" target="_blank"
                               class="text-gray-500 hover:text-gray-900 hover:bg-gray-100 rounded transition duration-150 ease-in font-medium text-sm text-center w-full py-3"> <i class="fa fa-linkedin-square" style="font-size:15px; color: #0e76a8" > Linkedin </i>  </a>
                               @endif
                        </div>

                        <br>
                        <div class="w-full ml-5">
                            <h3 class="font-medium text-gray-900 text-left px-6">Recent activites</h3>
                            <div class="mt-5 w-full flex flex-col items-center overflow-hidden text-sm">
                                <a href="#"
                                   class="w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                    <img src="https://avatars0.githubusercontent.com/u/35900628?v=4" alt=""
                                         class="rounded-full h-6 shadow-md inline-block mr-2">
                                    Joined {{$setting->site_name}}
                                    <span class="text-gray-500 text-xs">{{$user->created_at->diffForHumans()}}</span>
                                </a>

                                <a href="#"
                                   class="w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                    <img src="https://avatars0.githubusercontent.com/u/35900628?v=4" alt=""
                                         class="rounded-full h-6 shadow-md inline-block mr-2">
                                    Updated  profile
                                    <span class="text-gray-500 text-xs">{{$user->updated_at->diffForHumans()}}</span>
                                </a>

                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        </body>


    </div>

    </div>


    <script>

        $(document).ready(function () {
            new DataTable("#dataTable", {});
            const fetchListData = (url) => {
                $.ajax({
                    data: {},
                    method: 'GET',
                    url: url,
                    success: function (data) {
                        if (data.status) {
                            $("#listContainer").html(data.html);
                            new DataTable("#dataTable", {});
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }


                })
            }

            const globalModal = $("#globalModal");
            const modalContent = $("#modalContent");
            const el = document.querySelector("#programmatically-modal");
            const modal = tailwind.Modal.getOrCreateInstance(el);
            const hideModal = () => modal.hide();
            $(document).on('click', '.editElement', function () {

                let url = $(this).val();
                ajaxGet(url, 'GET', {}, showData)

            });
            function showData(response) {
                modal.show();
                if (response.status) {
                    modalContent.html(response.data);
                }
            }
            const ajaxGet = (url, method, data, callbackFunction) => {
                $.ajax({
                    type: method,
                    url: url,
                    data: data,
                    success: callbackFunction,
                    error: function (data) {
                        console.log(data);
                    }
                });
            }

        });


    </script>


    {{--    Template End --}}


@endsection