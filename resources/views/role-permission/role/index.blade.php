    @extends('layouts.master')

    @section('content')
        @push('style')
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <style>
                .swal2-actions button {
                    margin-right: 10px;
                    /* Adjust the margin as needed */
                }
            </style>
        @endpush
        @if (session('status'))
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 1800,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    },
                    customClass: {
                        popup: 'swal-toast'
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: "{{ session('status') }}"
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 1800,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    },
                    customClass: {
                        popup: 'swal-toast'
                    }
                });
                Toast.fire({
                    icon: "error",
                    title: "{{ session('error') }}"
                });
            </script>
        @endif

        @include('role-permission.nav-links')

        <div class="list-group w-auto p-3" style="border-radius: 10px">
            <div class="list-group-item" style="background-color: #3559E0" aria-current="true">
                <h4 style="color: #FFFFFF;" class="mt-2"><b>Role List</b></h4>
            </div>
            <div class="list-group-item">
                <div class="p-2 mt-3">

                    <form role="search" action="{{ url()->current() }}" method="GET">
                        @csrf
                        <div class="input-group inline">
                            <input type="text" class="form-control search-bar" name="search" style="border-radius: 10px"
                                placeholder="Search for something" aria-label="Search" />

                            <div>
                                <!-- Add refresh button -->
                                <button type="submit" class="btn btn-primary" value="Refresh"
                                    style="background-color: #3559E0; margin-left:1vw;">
                                    <i class="fas fa-sync-alt"></i> Refresh
                                </button>
                            </div>

                            <div>
                                @can('create user')
                                    <a href="{{ url('roles/create') }}" class="btn btn-primary "
                                        style="background-color: #3559E0; margin-left: 23vw;"><i
                                            class="fas fa-plus-circle fa-lg" style="color: #ffffff;"></i> Add New Role</a>
                                @endcan
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="sticky">
                            <tr>
                                <th class="p-3 col-2" scope="col"> ID </th>
                                <th class="p-3 col-4" scope="col"> Name </th>
                                <th class="p-3 col-auto" scope="col"> Action </th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            @foreach ($roles as $role)
                                <tr>
                                    <td class="p-3" scope="row"> {{ $role->id }} </td>
                                    <td class="p-3" scope="row"> {{ $role->name }} </td>
                                    <td class="p-3" scope="row">
                                        @role('super-admin')
                                            <a href="{{ url('roles/' . $role->id . '/give-permissions') }}"
                                                class="btn btn-warning">
                                                Add / Edit Role Permission </a>
                                        @endrole
                                        @role('super-admin')
                                            <a href="{{ url('roles/' . $role->id . '/edit') }}" type="button" class="btn edit"
                                                style="background-color: #3559E0;border: none;"><i class="fas fa-edit"
                                                    style="color: #ffffff;"></i></a>
                                        @endrole
                                        @can('delete role')
                                            <a class="btn trash" href="#"
                                                onclick="event.preventDefault(); confirmDelete({{ $role->id }})"
                                                style="background-color: #FF0000; border: none;">
                                                <i class="fas fa-trash" style="color: #ffffff;"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            function confirmDelete(roleId) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });

                swalWithBootstrapButtons.fire({
                    title: "Are you sure?",
                    text: "You want to delete this record!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        swalWithBootstrapButtons.fire({
                            title: "Deleted!",
                            text: "Role has been Deleted Successfully.",
                            icon: "success",
                            showConfirmButton: true
                        }).then(() => {
                            // Redirect to the delete URL if confirmed
                            window.location.href = "{{ url('roles') }}/" + roleId + "/delete";
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        // Do nothing if cancelled
                        swalWithBootstrapButtons.fire("Cancelled", "Your imaginary file is safe :)", "error");
                    }
                });
            }
        </script>
    @endsection
