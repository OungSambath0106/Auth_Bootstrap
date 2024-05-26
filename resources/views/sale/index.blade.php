@extends('layouts.master')
@section('content')
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
            <h4 style="color: #FFFFFF;" class=" mt-2"><b>All Sale List</b></h4>
        </div>
        <div class="list-group-item">

            <div class="table-responsive">

                <table class="table m-0">

                    <thead class="sticky">
                        <tr>
                            {{-- <th class="px-3 py-2" scope="col">#</th> --}}
                            <th class="px-3 py-2" scope="col">Customer Name</th>
                            <th class="px-3 py-2" scope="col">Total Paid</th>
                            <th class="px-3 py-2" scope="col">Status</th>
                            <th class="px-3 py-2" scope="col">Sub Total</th>
                            <th class="px-3 py-2" scope="col">Tax</th>
                            <th class="px-3 py-2" scope="col">Discount</th>
                            <th class="px-3 py-2" scope="col">Total Amount</th>
                            <th class="px-3 py-2" scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody class="tbody table-scroll">
                        @if ($invoices->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center">Table doesn't have any records.</td>
                            </tr>
                        @else
                            @foreach ($invoices as $inv)
                                <tr>
                                    {{-- <td class="px-3" style="padding-top: 12px;" scope="row"> {{ $inv->id }} </td> --}}
                                    <td class="px-3" style="padding-top: 12px;" scope="row">
                                        {{ @$inv->customer->customername }}
                                    </td>
                                    <td class="px-3" style="padding-top: 12px;" scope="row">
                                        {{ config('settings.currency_symbol') }} {{ $inv->total_paid }}
                                    </td>
                                    <td class="px-3" style="padding-top: 12px;" scope="row">
                                        @if ($inv->status == '1')
                                            <span class=" btn btn-sm btn-primary">Paid</span>
                                        @else
                                            <span class=" btn btn-sm btn-warning">Unpaid</span>
                                        @endif
                                    </td>
                                    <td class="px-3" style="padding-top: 12px;" scope="row">
                                        {{ config('settings.currency_symbol') }} {{ $inv->subtotal }}
                                    </td>
                                    <td class="px-3" style="padding-top: 12px;" scope="row">
                                        {{ config('settings.currency_symbol') }} {{ $inv->vat_amount ?? 0 }}
                                    </td>
                                    <td class="px-3" style="padding-top: 12px;" scope="row">
                                        {{ config('settings.currency_symbol') }} {{ $inv->discount_amount ?? 0 }}
                                    </td>
                                    <td class="px-3" style="padding-top: 12px;" scope="row">
                                        {{ config('settings.currency_symbol') }} {{ $inv->total }}
                                    </td>
                                    <td class="px-3" scope="row">
                                        <form id="deleteForm{{ $inv->id }}"
                                            action="{{ route('invoice.destroy', ['invoice' => $inv->id]) }}"
                                            method="post">
                                            <a href="{{ route('invoice.show', $inv->id) }}" type="button" class="btn view"
                                                title="@lang('Print')" style="background-color: #38E035;border: none;">
                                                <i class="fas fa-print" style="color: #ffffff;"></i>
                                            </a>
                                            @role('super-admin|developer|admin')
                                                {{-- <a href="{{ route('invoice.edit', $inv->id) }}" type="button"
                                                    class="btn edit" title="@lang('Edit')"
                                                    style="background-color: #3559E0; border: none;">
                                                    <i class="fas fa-edit" style="color: #ffffff;"></i>
                                                </a> --}}
                                                @csrf
                                                @method('DELETE')
                                                <a class="btn trash delete-button" type="button" title="@lang('Delete')"
                                                    style="background-color: #FF0000;border: none;"
                                                    data-invoice-id="{{ $inv->id }}">
                                                    <i class="fas fa-trash" style="color: #ffffff;"></i></a>
                                            @endrole
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>

                    <tfoot class="sticky">
                        <tr>
                            {{-- <th></th> --}}
                            <th></th>
                            <th>Total Paid: {{ config('settings.currency_symbol') }} {{ $totalpaid, 2 }}</th>
                            <th></th>
                            <th>Subtotal: {{ config('settings.currency_symbol') }} {{ $subtotal, 2 }}</th>
                            <th>Total Tax: {{ config('settings.currency_symbol') }} {{ $totalvat, 2 }}</th>
                            <th>Total Discount: {{ config('settings.currency_symbol') }} {{ $discount, 2 }}</th>
                            <th>Total Amount: {{ config('settings.currency_symbol') }} {{ $total_amount, 2 }}</th>
                            <th></th>
                        </tr>
                    </tfoot>

                </table>

            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.delete-button').on('click', function(e) {
                var invoiceId = $(this).data('invoice-id');
                Swal.fire({
                    title: "Are you sure?",
                    text: "You want to delete this record!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#deleteForm' + invoiceId).submit();
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
                "pageLength": 7,

            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
