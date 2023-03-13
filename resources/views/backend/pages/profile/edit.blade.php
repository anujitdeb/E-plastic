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

    $modal_title ='Profile';
    $store_route = '';
    $update_route='';
    if(isset($user)){
         $update_route = route('dashboard.profile.update', $user->id);
         $data = $user;
    }
    $fetch_route = route('dashboard.profile.index');
@endphp
<div class="intro-y text-primary text-2xl font-bold text-left pt-4 pb-2 mb-2 border-b-2 ">
    @isset($data)
        Update
    @endif {{$modal_title}}
</div>
<form class="validate-form text-lg" id="submitForm"
      @if(isset($data))
          action="{{$update_route}}"
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
               placeholder="Name" required>
    </div>
    <div>
        <label class="flex flex-col sm:flex-row">{{ucfirst($modal_title)}} Image?
        </label>
        <input type="file" name="image" class="input w-full border mt-2" placeholder="Manager">
    </div>

    <div class="col-span-6">
        <label class="flex flex-col sm:flex-row">Phone?
        </label>
        <input type="text" name="phone" @if(isset($data)) value="{{$data->phone}}"
               @endif class="input w-full border mt-2"
               placeholder="01700000000" required>
    </div>
    <div class="col-span-6">
        <label class="flex flex-col sm:flex-row">Facebook?
        </label>
        <input type="text" name="facebook" @if(isset($data)) value="{{$data->facebook}}"
               @endif class="input w-full border mt-2"
               placeholder="">
    </div>
    <div class="col-span-6">
        <label class="flex flex-col sm:flex-row">Twitter ?
        </label>
        <input type="text" name="twitter" @if(isset($data)) value="{{$data->twitter}}"
               @endif class="input w-full border mt-2"
               placeholder="">
    </div>
    <div class="col-span-6">
        <label class="flex flex-col sm:flex-row">Instagram ?
        </label>
        <input type="text" name="instagram" @if(isset($data)) value="{{$data->instagram}}"
               @endif class="input w-full border mt-2"
               placeholder="">
    </div>
    <div class="col-span-6">
        <label class="flex flex-col sm:flex-row">Linkedin ?
        </label>
        <input type="text" name="linkedin" @if(isset($data)) value="{{$data->linkedin}}"
               @endif class="input w-full border mt-2"
               placeholder="">
    </div>

    </div>


    <div class="flex flex-row-reverse mt-2">
        <button type="submit" class="btn btn-primary w-full shadow-md mr-2 ">@isset($data)
                Update
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
                        //reload page
                        location.reload();


                    } else {
                        console.log(data);
                        Toast.fire({
                            icon: 'error',
                            title: 'Something went wrong'
                        })
                    }
                },
                error: function (data) {
                    //check data status

                    if (data.status === 422) {
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