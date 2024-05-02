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

            .filter{
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
        <div class="list-group-item d-flex justify-content-between" style="background-color: #3559E0" aria-current="true">
            <h4 style="color: #FFFFFF;" class=" mt-2 col-0"><b>Menus List</b></h4>
            <div class="col-sm-3 filter mt-1">
                <select id="catelog-filter" class="form-control">
                    <option value="" {{ !request()->filled('menu_type') ? 'selected' : '' }}>All Catalog</option>
                    @foreach ($menu_types as $type)
                        <option value="{{ $type }}" {{ request('menu_type') == $type ? 'selected' : '' }}>
                            {{ $type }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class=" col-3"></div>
        </div>
        <div class="list-group-item">
            <div class="table-responsive">

                <table id="example1" class="table">

                    <thead class="sticky">
                        <tr>
                            <th class="px-3 py-2 col-1" scope="col">#</th>
                            <th class="px-3 py-2 col-2" scope="col">Menu Name</th>
                            <th class="px-3 py-2 col-2" scope="col">Menu Type</th>
                            <th class="px-3 py-2 col-2" scope="col">Sale Price</th>
                            <th class="px-3 py-2 col-2" scope="col">Description</th>
                            <th class="px-3 py-2 col-1" scope="col">Status</th>
                            <th class="px-3 py-2 col-auto" scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody class="tbody">
                        @foreach ($menus as $menu)
                            <tr>
                                <td class="px-3" scope="row"> {{ $menu->id }} </td>
                                <td class="px-3" scope="row"> {{ $menu->menuname }} </td>
                                <td class="px-3" scope="row"> {{ $menu->menutype }} </td>
                                <td class="px-3" scope="row">$ {{ $menu->price }} </td>
                                <td class="px-3" scope="row"> {{ $menu->description }} </td>
                                <td class="px-3" style="padding-top: 12px;" scope="row">
                                    @if ($menu->ishidden == 1)
                                        <span class="badge bg-success badge-xl mx-1">Active</span>
                                    @else
                                        <span class="badge bg-danger badge-xl mx-1">Inactive</span>
                                    @endif
                                </td>
                                <td class="px-3" scope="row">
                                    @can('view menu')
                                        <a href="{{ url('menus/' . $menu->id) }}" type="button" class="btn view"
                                            style="background-color: #38E035;border: none;">
                                            <i class="fas fa-eye" style="color: #ffffff;"></i>
                                        </a>
                                    @endcan
                                    @can('update menu')
                                        <a href="{{ url('menus/' . $menu->id . '/edit') }}" type="button" class="btn edit"
                                            style="background-color: #3559E0;border: none;">
                                            <i class="fas fa-edit" style="color: #ffffff;"></i>
                                        </a>
                                    @endcan
                                    @can('delete menu')
                                        <a class="btn trash" href="#"
                                            onclick="event.preventDefault(); confirmDelete({{ $menu->id }})"
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
        function confirmDelete(menuId) {
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
                        text: "Menu has been Deleted Successfully.",
                        icon: "success",
                        showConfirmButton: true
                    }).then(() => {
                        // Redirect to the delete URL if confirmed
                        window.location.href = "{{ url('menus') }}/" + menuId + "/delete";
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    // Do nothing if cancelled
                    swalWithBootstrapButtons.fire("Cancelled", "Your imaginary file is safe :)", "error");
                }
            });
        }
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
            $("#catelog-filter").change(function() {
                var selectedValue = $(this).val();
                $("#example1").DataTable().column(2).search(selectedValue).draw();
            });

            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [ // Custom button configuration
                    @can('create menu')
                        {

                            text: 'Create New Menu',
                            className: 'btn btn-primary btn-default',
                            action: function() {
                                window.location.href = "{{ url('menus/create') }}";
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
