@extends('../layout/' . $layout)

@section('subhead')
    <title>Dashboard - Admin</title>
@endsection

@section('subcontent')

    <h2 class="intro-y text-lg font-medium mt-10">Manage Fair <span class="font-extrabold">{{$fair->name}}</span></h2>
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        <button class="btn btn-primary shadow-md mr-2" type="button" id="addNew">Add New Book Stall</button>


    </div>
    <div class="mt-4">
        @include('organizer.pages.shop.list')
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
            $(document).on('click', '.deleteElement', function () {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {

                    let url = $(this).val();
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "_method": "DELETE",

                        },
                        success: function (data) {
                            $("#listContainer").html(data.html);
                            if (data.status == 'success') {
                                fetchListData("{{route('organizer.stall.list')}}");
                                Swal.fire(
                                    'Deleted!',
                                    'Your data has been deleted.',
                                    'success'
                                )

                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Your data has not been deleted.',
                                    'error'
                                )
                            }
                        }
                    });
                })


            });

            function showData(response) {
                modal.show();
                if (response.status) {
                    modalContent.html(response.data);
                }
            }

            $("#addNew").on('click', () => {
                console.log("add new");
                let url = "{{route('organizer.stall.create')}}";
                ajaxGet(url, 'GET', {
                    fair_id: "{{$fair->id}}"
                }, showData);
            });


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
@endsection



