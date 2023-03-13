@extends('../layout/' . $layout)

@section('subhead')
    <title>Dashboard - Role</title>
@endsection

@section('subcontent')

    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
        <!-- BEGIN: Change Password -->
        <div class="intro-y box lg:mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">Change Password</h2>
            </div>
            <form id="password-form">
                @csrf
                <div class="p-5">
                    <div>
                        <label for="current_password" class="form-label">Current Password</label>
                        <input id="current_password" type="password" name="current_password"  class="form-control" placeholder="Current Password">
                        <span class="" id="current_password_error"></span>
                    </div>
                    <div class="mt-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input id="new_password" type="password" name="new_password" class="form-control" placeholder="New Password">
                        <span class="" id="new_password_error" style="color: #990000"></span>
                    </div>
                    <div class="mt-3">
                        <label for="confirm_password" class="form-label">Confirm New Password</label>
                        <input id="confirm_password" type="password" name="confirm_password"  class="form-control" placeholder="Confirm Password">
                        <span class="" id="confirm_password_error" style="color: #990000"></span>
                    </div>
                    <button type="submit" id="change-password-btn" class="btn btn-primary mt-4">Change Password</button>
                </div>
            </form>
        </div>
        <!-- END: Change Password -->
    </div>

    <script>
        $(document).ready(function(){
            $("#password-form").on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '{{ route("dashboard.profile.changePassword.submit") }}',
                    data: $(this).serialize(),
                    success: function(data) {
                        if(data.status == 'success'){
                            Swal.fire({
                                title: 'Success!',
                                text: data.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                            // clear form
                            $("#password-form")[0].reset();

                            //reload page
                            setTimeout(function(){
                                location.reload();
                            }, 2000);

                            location.href = "{{ route('dashboard.profile.changePassword') }}";
                        }
                        else if(data.status == 'error'){
                            Swal.fire({
                                title: 'Error!',
                                text: data.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                        else{
                            Swal.fire({
                                title: 'Error!',
                                text: 'Please check the form for errors.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(data){
                        var errors = data.responseJSON.errors;
                        $.each(errors, function(key, value){
                            $("#" + key + "_error").html(value);
                        });
                    }
                });
            });
        });
    </script>

@endsection