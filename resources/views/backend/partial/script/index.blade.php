<!-- This is global script for index -->
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
                            fetchListData("{{route('dashboard.admins.list')}}");
                            Swal.fire(
                                'Deleted!',
                                data.message,
                                'success'
                            )

                        } else {
                            Swal.fire(
                                'Error!',
                                data.message,
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
            let url = "{{route($createRoute)}}";
            ajaxGet(url, 'GET', {}, showData);
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