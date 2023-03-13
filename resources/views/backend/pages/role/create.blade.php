<!-- Create Function goes here -->
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- form -->
@php

    $modal_title ='Role';
@endphp
<div class="intro-y text-primary text-2xl font-bold text-left pt-4 pb-2 mb-2 border-b-2 ">
    @isset($role)
        Update
    @else
        Create New
    @endif {{$modal_title}}
</div>
<form class="validate-form text-lg" id="submitForm"
      @if(isset($role))
          action="{{ route('dashboard.role.update', $role->id) }}"
      @else
          action="{{ route('dashboard.role.store') }}"
    @endif
>
    @if(isset($role))
        <input type="hidden" name="_method" value="PUT">
    @endif
    @csrf
    <div>
        <label class="flex flex-col sm:flex-row">Role Name? (required)
            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, at least 2 characters</span>
        </label>
        <input type="text" name="name" @if(isset($role)) value="{{$role->name}}" @endif class="input w-full border mt-2"
               placeholder="Manager" required>


    </div>

    @if(!isset($role))
        <div class="mt-3">
            <label class="flex flex-col sm:flex-row">Select a Guard ? (required)
                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, at least 2 characters</span>
            </label>
            <select name="guard_name" id="select_guard" class="form-select w-full ">
                <option value="admin">admin</option>
                <option value="web">web</option>
            </select>

        </div>
    @endif
    <div class="mt-3 grid grid-cols-3">


        @foreach($permissions as $item)
            <div class="col-span-1 flex items-center text-gray-700 ">
                <input type="checkbox" class="input border mr-2" @isset($role)
                    {{ $role->hasPermissionTo($item->name) ? 'checked' : '' }}
                @endisset value="{{ $item->name }}" name="permissions[]" id="permission-{{ $loop->index }}">
                <label class="cursor-pointer select-none" for="permission-{{ $loop->index }}">
                    {{ucwords(str_replace('.',' ',$item->name))}}
                    <small
                        class="text-white rounded-full px-1 report-box__indicator bg-theme-18 tooltip cursor-pointer tooltipstered">{{ $item->guard_name }}</small></label>
            </div>
        @endforeach


    </div>


    <div class="flex flex-row-reverse mt-2">
        <button type="submit" class="btn btn-primary w-full shadow-md mr-2 ">@isset($role)
                Update
            @else
                Create
            @endif  {{$modal_title}} </button>

    </div>
</form>
<!-- end form -->

<script>
    $(document).ready(function () {
        const el = document.querySelector("#programmatically-modal");
        const modal = tailwind.Modal.getOrCreateInstance(el);
        const hideModal = () => modal.hide();

        $("#submitForm").submit(function (e) {
            e.preventDefault();
            var form = $(this);
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: form.attr('action'),
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    if (data.status) {
                        Toast.fire({
                            icon: 'success',
                            title: data.message
                        })
                        hideModal();
                        fetchListData("{{route('dashboard.roles.list')}}");

                    } else {
                        console.log(data);
                        Toast.fire({
                            icon: 'error',
                            title: 'Something went wrong'
                        })
                    }
                },
                error: function (data) {
                    if (data.status == 422) {
                        Toast.fire({
                            icon: 'error',
                            title: 'Validation Error'
                        });
                        var errors = data.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            var input = '[name=' + key + ']';
                            $(input + '+.validation-error-text').remove();
                            $(input).after('<p class="validation-error-text text-danger">' + value + '</p>');
                        });
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Something went wrong'
                        })
                    }

                }
            });
        });

        $('#extendDetails').click(function () {
            $(this).hide();
            $('#organizerDetails').show();
        });
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

    });

</script>
