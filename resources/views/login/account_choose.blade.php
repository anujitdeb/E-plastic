<div class="dropdown mt-4 w-full">
    <button class="dropdown-toggle w-1/2 btn btn-secondary" aria-expanded="false" data-tw-toggle="dropdown">Choose Another Account</button>
    <div class="dropdown-menu w-1/2">
        @php
           /* $login_links=[['name'=>'Admin','route'=>'admin.login'],['name'=>'Organizer','route'=>'organizer.login'],
            ['name'=>'Book Stall Owner','route'=>'stall.login']]*/
        $login_links=[['name'=>'Admin','route'=>'dashboard.login']]
        @endphp



        <ul class="dropdown-content">
            @foreach($login_links as $link)
                <li>
                    <a href="{{route($link['route'])}}" class="dropdown-item">
                        <i data-feather="user-plus" class="w-4 h-4 mr-2"></i> {{$link['name']}}
                    </a>
                </li>
            @endforeach

        </ul>
    </div>
</div>
