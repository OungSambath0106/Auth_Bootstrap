@extends('layouts.master')
@section('content')
    @push('style')
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            .swal2-actions button {
                margin-right: 10px;
                /* Adjust the margin as needed */
            }

            .dt-buttons {
                height: 40px;
            }

            .col-md-6 {
                width: 100% !important;
            }

            .img-thumbnail {
                width: 30px !important;
                height: 30px !important;
            }

            .dataTables_wrapper .dataTables_filter input[type="search"] {
                min-width: 37vw !important;
                padding: 10px !important;
                font-size: 16px !important;
                border-radius: 10px !important;
                color: #3559e0;
                border-color: #3559e0;
                margin-left: 10px;
                height: 40px;
            }

            .dataTables_wrapper .dataTables_filter input[type="search"]::placeholder {
                color: #3559e0;
            }

            .btn-primary {
                background-color: #3559e0;
                border: none
            }

            .btn-primary:hover {
                background-color: #3559e0;
                border: none
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

    <div class="list-group w-auto p-3 mt-1" style="border-radius: 10px">
        <div class="list-group-item" style="background-color: #3559E0" aria-current="true">
            <h4 style="color: #FFFFFF;" class=" mt-2"><b>Customers List</b></h4>
        </div>
        <div class="list-group-item">

            <div class="table-responsive">

                <table id="example1" class="table">

                    <thead class="sticky">
                        <tr>
                            <th class="px-3 py-2" scope="col">#</th>
                            <th class="px-3 py-2" scope="col">Customer Name</th>
                            <th class="px-3 py-2" scope="col">Company Name</th>
                            <th class="px-3 py-2" scope="col">Email</th>
                            <th class="px-3 py-2" scope="col">Phone</th>
                            <th class="px-3 py-2" scope="col">Address</th>
                            <th class="px-3 py-2" scope="col">Status</th>
                            <th class="px-3 py-2" scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody class="tbody">
                        @foreach ($customers as $cus)
                            <tr>
                                <td class="px-3" style="padding-top: 12px;" scope="row"> {{ $cus->id }} </td>
                                <td class="px-3" style="padding-top: 12px;" scope="row"> {{ $cus->customername }} </td>
                                <td class="px-3" style="padding-top: 12px;" scope="row"> {{ $cus->companyname }} </td>
                                <td class="px-3" style="padding-top: 12px;" scope="row">
                                    {{ Str::limit($cus->email, 15) }} </td>
                                <td class="px-3" style="padding-top: 12px;" scope="row"> {{ $cus->phone }} </td>
                                <td class="px-3" style="padding-top: 12px;" scope="row">
                                    {{ Str::limit($cus->address, 10) }} </td>
                                <td class="px-3" style="padding-top: 12px;" scope="row">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input ishidden" role="switch"
                                            id="ishidden_{{ $cus->id }}" data-id="{{ $cus->id }}"
                                            {{ $cus->ishidden == 1 ? 'checked' : '' }} name="ishidden">
                                        <label class="custom-control-label" for="ishidden_{{ $cus->id }}"></label>
                                    </div>
                                </td>
                                <td class="px-3" scope="row">
                                    @can('update customer')
                                        <a href="{{ url('customers/' . $cus->id . '/edit') }}" type="button" class="btn edit"
                                            title="@lang('Edit')" style="background-color: #3559E0;border: none;">
                                            <i class="fas fa-edit" style="color: #ffffff;"></i>
                                        </a>
                                    @endcan
                                    @can('delete customer')
                                        <a class="btn trash" href="#"
                                            onclick="event.preventDefault(); confirmDelete({{ $cus->id }})"
                                            title="@lang('Delete')" style="background-color: #FF0000; border: none;">
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
        function confirmDelete(customerId) {
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
                reverseButtons: false
            }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire({
                        title: "Deleted!",
                        text: "Customer has been Deleted Successfully.",
                        icon: "success",
                        showConfirmButton: true
                    }).then(() => {
                        // Submit the form
                        document.getElementById('deleteForm_' + customerId).submit();
                    });
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.ishidden').change(function() {
                var checkbox = $(this);
                var menuId = checkbox.data('id');

                $.ajax({
                    url: '{{ route('customers.update_ishidden') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: menuId
                    },
                    success: function(response) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
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

                        if (response.status == 1) {
                            Toast.fire({
                                icon: 'success',
                                title: response.message
                            });
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: response.message
                            });
                        }
                    },
                    error: function() {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
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
                            icon: 'error',
                            title: '{{ __('An error occurred while updating the status.') }}'
                        });
                    }
                });
            });
        });
    </script>
@endsection

@push('script')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                // "buntton" : false,
                "buttons": [
                    @can('create customer')
                        {
                            text: 'Create New Customer',
                            className: 'btn btn-primary btn-default',
                            action: function() {
                                window.location.href = "{{ url('customers/create') }}";
                            }
                        }
                    @endcan
                ],
                "language": {
                    "search": "",
                    "searchPlaceholder": "        Search for something...",
                },
                "pageLength": 7,
                "dom": // Custom DOM layout with search input on the left and buttons on the right
                    "<'row mt-2 mb-2 px-3'<'col-md-6 d-flex justify-content-between'f>B>" +
                    "<'row'<'col-md-12'tr>>" +
                    "<'row'<'col-md-5'i><'col-md-7'p>>"

            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            // Add custom search icon
            $('.dataTables_filter input[type="search"]').css({
                'background-image': 'url("data:image/svg+xml,%3csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'%233559e0\' viewBox=\'0 0 512 512\'%3e%3cpath d=\'M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.8 44-128C416 85.96 330.1 0 224 0S32 85.96 32 192s85.96 192 192 192c48.17 0 92.66-16.38 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.38 9.38 24.6 9.38 33.98 0l28.3-28.3c9.38-9.37 9.38-24.56.02-33.94zM224 336c-70.7 0-128-57.3-128-128s57.3-128 128-128 128 57.3 128 128-57.3 128-128 128z\'/%3e%3c/svg%3e")',
                'background-repeat': 'no-repeat',
                'background-position': 'left 10px center',
                'background-size': '22px'
            });
            $('.dataTables_filter input[type="search"]').on('input', function() {
                var input = $(this);
                if (input.val().length > 0) {
                    input.css('background-image', 'none');
                } else {
                    input.css('background-image',
                        'url("data:image/svg+xml,%3csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'%233559e0\' viewBox=\'0 0 512 512\'%3e%3cpath d=\'M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.8 44-128C416 85.96 330.1 0 224 0S32 85.96 32 192s85.96 192 192 192c48.17 0 92.66-16.38 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.38 9.38 24.6 9.38 33.98 0l28.3-28.3c9.38-9.37 9.38-24.56.02-33.94zM224 336c-70.7 0-128-57.3-128-128s57.3-128 128-128 128 57.3 128 128z\'/%3e%3c/svg%3e")'
                    );
                }
            });
        });
    </script>
@endpush
