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

    $modal_title ='Admin';
    $store_route = route('dashboard.admin.store');
    $update_route='';
    if(isset($admin)){
         $update_route = route('dashboard.admin.update', $admin->id);
         $data = $admin;
    }
    $fetch_route = route('dashboard.admins.list');
@endphp
<div class="intro-y text-primary text-2xl font-bold text-left pt-4 pb-2 mb-2 border-b-2 ">
    @isset($data)
        Update
    @else
        Create New
    @endif {{$modal_title}}
</div>
<form class="validate-form text-lg" id="submitForm"
      @if(isset($data))
          action="{{$update_route}}"
      @else
          action="{{$store_route}}"
        @endif
>
    @if(isset($data))
        <input type="hidden" name="_method" value="PUT">
    @endif
    @csrf
    <div>
        <label class="flex flex-col sm:flex-row">{{ucfirst($modal_title)}} Name? (required)
            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, at least 2 characters</span>
        </label>
        <input type="text" name="name" @if(isset($data)) value="{{$data->name}}" @endif class="input w-full border mt-2"
               placeholder="Manager" >
    </div>
    <div>
        <label class="flex flex-col sm:flex-row">{{ucfirst($modal_title)}} username? (required)
            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, at least 2 characters</span>
        </label>
        <input type="text" name="username" @if(isset($data)) value="{{$data->username}}"
               @endif class="input w-full border mt-2"
               placeholder="anything" >
    </div>
    <div class="grid grid-cols-12 gap-2 mt-3">
        <div class="col-span-6">
            <label class="flex flex-col sm:flex-row">Email?
            </label>
            <input  type="email" name="email" @if(isset($data)) value="{{$data->email}}"
                    @endif class="input w-full border mt-2"
                    placeholder="example@gmail.com" >

        </div>

        <div class="col-span-6">
            <label class="flex flex-col sm:flex-row" for="elect_role">Choose a Role
            </label>
            <select name="role" id="select_role" class="input-select w-full mt-2" >
                <option  >Select Role</option>
                @foreach($roles as $role)



                    <option  value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-span-6">
            <label class="" for="password">Password?
            </label>
            <input id="password" type="password" name="password" class=" form-input w-full border "
                   placeholder="password">
        </div>
        <div class="col-span-6">
            <label class="flex flex-col sm:flex-row">Confirm Password?
            </label>
            <input type="password" name="password_confirmation" class="input w-full border"
                   placeholder="password" @if(!isset($data))  @endif>
        </div>


    </div>


    <div class="flex flex-row-reverse mt-2">
        <button type="submit" class="btn btn-primary w-full shadow-md mr-2 ">@isset($data)
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
                        fetchListData("{{$fetch_route}}");

                    } else {
                        console.log(data);
                        Toast.fire({
                            icon: 'error',
                            title: data.message+'Something went wrong'
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
