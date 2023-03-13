@extends('../withoutLoginLayout/' . $layout)

@section('subhead')
    <title>Eplastic</title>
@endsection

@section('subcontent')


    <div class="mx-6 pb-8 pt-10">
        <div class="fade-mode">
            <div class="h-64 px-2">
                <div class="h-full image-fit rounded-md overflow-hidden">
                    <img alt="Slider image 1" src="{{asset('dist/slider/slider1.png')}}" />
                </div>
            </div>
            <div class="h-64 px-2">
                <div class="h-full image-fit rounded-md overflow-hidden">
                    <img alt="Slider image 2" src="{{asset('dist/slider/slider2.jpg')}}" />
                </div>
            </div>
            <div class="h-64 px-2">
                <div class="h-full image-fit rounded-md overflow-hidden">
                    <img alt="Slider image 3" src="{{asset('dist/slider/slider3.jpg')}}" />
                </div>
            </div>
            <div class="h-64 px-2">
                <div class="h-full image-fit rounded-md overflow-hidden">
                    <img alt="Slider image 4" src="{{asset('dist/slider/slider4.jpg')}}" />
                </div>
            </div>
            <div class="h-64 px-2">
                <div class="h-full image-fit rounded-md overflow-hidden">
                    <img alt="Slider image 5" src="{{asset('dist/slider/slider5.jpg')}}" />
                </div>
            </div>
        </div>
    </div>

    <div class="intro-y flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-5">Our Stations</h2>
    </div>
    <div class="flex">
        <div class="w-full sm:w-1/2 md:w-1/4 p-2">
            <div class="bg-white rounded-lg shadow-lg p-1">
                <img src="{{asset('dist/stations/station1.webp')}}" alt="Image 1" class="w-full rounded-t-lg">
                <div class="p-4">
                    <h3 class="text-lg font-medium">Dhaka North</h3>
                    <p class="text-gray-600">Station 1, Road-15, Banani, Dhaka</p>
                </div>
            </div>
        </div>
        <div class="w-full sm:w-1/2 md:w-1/4 p-2">
            <div class="bg-white rounded-lg shadow-lg p-1">
                <img src="{{asset('dist/stations/station2.jpg')}}" alt="Image 2" class="w-full rounded-t-lg">
                <div class="p-4">
                    <h3 class="text-lg font-medium">Dhaka South</h3>
                    <p class="text-gray-600">Station 2, Lake Circus,Kalabagan, Dhaka</p>
                </div>
            </div>
        </div>
        <div class="w-full sm:w-1/2 md:w-1/4 p-2">
            <div class="bg-white rounded-lg shadow-lg p-1">
                <img src="{{asset('dist/stations/station3.jpg')}}" alt="Image 3" class="w-full rounded-t-lg">
                <div class="p-4">
                    <h3 class="text-lg font-medium">Dhaka East</h3>
                    <p class="text-gray-600">Station 3, aci centre 245, tejgaon, Dhaka</p>
                </div>
            </div>
        </div>
        <div class="w-full sm:w-1/2 md:w-1/4 p-2">
            <div class="bg-white rounded-lg shadow-lg p-1">
                <img src="{{asset('dist/stations/station4.jpg')}}" alt="Image 4" class="w-full rounded-t-lg">
                <div class="p-4">
                    <h3 class="text-lg font-medium">Dhaka West</h3>
                    <p class="text-gray-600">Station 4, Bishil Road, Mirpur-1, Dhaka</p>
                </div>
            </div>
        </div>
    </div>



@endsection
