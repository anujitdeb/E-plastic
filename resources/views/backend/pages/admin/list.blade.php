<!-- BEGIN: Data List -->

<table id="dataTable" class="table table-report -mt-2">
    <thead>
    <tr>
        <th class="whitespace-no-wrap" width="10%"></th>
        <th class="whitespace-no-wrap"> NAME</th>
        <th class="text-center whitespace-no-wrap">Role</th>
        <th class="text-center whitespace-no-wrap">Email</th>
        @if( auth('admin')->user() && ( auth('admin')->user()->can('admin.edit') || auth('admin')->user()->can('admin.delete')))
            <th class="text-center whitespace-no-wrap">ACTIONS</th>
        @endif
    </tr>
    </thead>
    <tbody>

    @foreach ($admins as $admin)
        <tr class="intro-x">
            <td class="w-40">
                <div class="flex">
                    <div class="w-10 h-10 image-fit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-users mx-auto">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>

                </div>
            </td>
            <td class="text-start">
                <span  class="font-medium whitespace-no-wrap">{{ $admin->name }}</span>

            </td>
            <td class="text-start">
                @foreach ($admin->roles as $role)
                    <span class=" rounded-full bg-primary text-white px-2 py-1">{{$role->name}}</span>
                @endforeach
            </td>
            <td class="text-start">{{ $admin->email }}</td>
            @if( auth('admin')->user() && ( auth('admin')->user()->can('admin.edit') || auth('admin')->user()->can('admin.delete')))
                <td class="table-report__action w-56">
                    <div class="flex  items-center">
                        @if( auth('admin')->user() && auth('admin')->user()->can('admin.edit'))
                            <button class="flex items-center editElement mr-3"
                                    value="{{route('dashboard.admin.edit',$admin->id)}}">
                                <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
                            </button>
                        @endif
                        @if( auth('admin')->user() && auth('admin')->user()->can('admin.delete'))

                            <button class="flex items-center text-danger deleteElement"
                                    value="{{route('dashboard.admin.destroy',$admin->id)}}">
                                <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete
                            </button>
                        @endif
                    </div>

                </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>

<!-- END: Data List -->
