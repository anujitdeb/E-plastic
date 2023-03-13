@extends('../layout/' . $layout)

@section('subhead')
    <title>Dashboard - Setting</title>
@endsection

@section('subcontent')

    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
        <!-- BEGIN: Change Password -->
        <div class="intro-y box lg:mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">Global Setting</h2>
            </div>
            <form id="setting-form" enctype="multipart/form-data" >
                @csrf
                <div class="p-5">
                    <div>
                        <label for="site_name" class="form-label">Site Name</label>
                        <input id="site_name" type="text" name="site_name"  class="form-control" value="{{$global_setting->site_name}}">
                    </div>
                    <div class="mt-3">
                        <label for="site_title" class="form-label">Site Title</label>
                        <input id="site_title" type="text" name="site_title" class="form-control"  value="{{$global_setting->site_title}}">
                    </div>



                    <div class="mt-3">
                        <label for="logo" class="form-label">Site Logo</label>
                        <input id="logo" type="file" name="logo"  class="form-control" accept="image/*"  >
                        <img src="{{asset('uploads/logo/'.$global_setting->logo)}}" alt="logo" width="100px" height="100px">
                    </div>
                    <div class="mt-3">
                        <label for="favicon" class="form-label">Site Favicon</label>
                        <input id="favicon" type="file" name="favicon"  class="form-control" accept="image/*">
                        <img src="{{asset('uploads/favicon/'.$global_setting->favicon)}}" alt="favicon" width="100px" height="100px">
                    </div>
                    <div class="mt-3">
                        <label for="site_email" class="form-label">Site Email</label>
                        <input id="site_email" type="text" name="site_email"  class="form-control"  value="{{$global_setting->site_email}}">
                    </div>
                    <div class="mt-3">
                        <label for="site_phone" class="form-label">Site Phone</label>
                        <input id="site_phone" type="text" name="site_phone"  class="form-control"  value="{{$global_setting->site_phone}}">
                    </div>
                    <div class="mt-3">
                        <label for="site_address" class="form-label">Site Address</label>
                        <input id="site_address" type="text" name="site_address"  class="form-control"  value="{{$global_setting->site_address}}">
                    </div>
                    <div class="mt-3">
                        <label for="facebook" class="form-label">Site Facebook</label>
                        <input id="facebook" type="text" name="facebook"  class="form-control"  value="{{$global_setting->facebook}}">
                    </div>
                    <div class="mt-3">
                        <label for="twitter" class="form-label">Site Twitter</label>
                        <input id="twitter" type="text" name="twitter"  class="form-control"  value="{{$global_setting->twitter}}">
                    </div>
                    <div class="mt-3">
                        <label for="instagram" class="form-label">Site Instagram</label>
                        <input id="instagram" type="text" name="instagram"  class="form-control"  value="{{$global_setting->instagram}}">
                    </div>
                    <div class="mt-3">
                        <label for="youtube" class="form-label">Site Youtube</label>
                        <input id="youtube" type="text" name="youtube"  class="form-control"  value="{{$global_setting->youtube}}">
                    </div>
                    <div class="mt-3">
                        <label for="linkedin" class="form-label">Site Linkedin</label>
                        <input id="linkedin" type="text" name="linkedin"  class="form-control"  value="{{$global_setting->linkedin}}">
                    </div>
                    <div class="mt-3">
                        <label for="pinterest" class="form-label">Site Pinterest</label>
                        <input id="pinterest" type="text" name="pinterest"  class="form-control"  value="{{$global_setting->pinterest}}">
                    </div>




                    <button type="submit" id="change-setting-btn" class="btn btn-primary mt-4">Submit</button>
                </div>
            </form>
        </div>
        <!-- END: Change Password -->
    </div>

    <script>


        $(document).ready(function(){
            $("form#setting-form").on('submit', function(e) {
                e.preventDefault();
                //remove every error messages
                $('.error-custom-validation').remove();
                let formData = new FormData();
                //assign value of the form in the formdata
                let form = $(this);
                let url = form.attr('action');
                let method = form.attr('method');
                let data = form.serializeArray();
                $.each(data, function(i, v) {
                    formData.append(v.name, v.value);
                });
                console.log(formData);
                $.each($("input[type='file']"), function(i, tag) {
                    $.each($(tag)[0].files, function(i, file) {
                        formData.append(tag.name, file);
                    });
                });
                $.ajax({
                    url: "{{route('dashboard.global-setting.update')}}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#change-setting-btn').html('Loading...');
                    },
                    success: function(response) {
                        if(response.status) {
                            $('#change-setting-btn').html('Submit');

                            Swal.fire({
                                title: 'Success!',
                                timer: 1500,
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            }); setTimeout(function(){
                                location.reload();
                            }, 1750);

                        } else {
                            $('#change-setting-btn').html('Submit');

                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            })


                        }
                    },
                    error: function(response) {
                        $('#change-setting-btn').html('Submit');
                       //Check if the response is 422
                        if(response.status === 422) {
                            //Get the errors
                            let errors = response.responseJSON.errors;
                            //Loop through the errors
                            $.each(errors, function(key, value) {
                                //add the error to the error with name of the input
                                $('input[name=' + key + ']').after('<span class="text-danger error-custom-validation">' + value + '</span>');
                            });
                        }
                    }
                });
            });
        });
    </script>

@endsection