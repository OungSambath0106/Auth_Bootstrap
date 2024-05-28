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

        .btn-filter {
            width: 80px !important;
        }

        .filter {
            height: 35px !important;
        }

        .reset {
            height: 35px !important;
        }

        .thead {
            border-top: solid 1px #3559E0;
        }

        .footer {
            border-bottom-color: #3559E0;
        }

        .btn-sm {
            height: 28px;
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
            <div class="row">
                <div class="col-md-12" style="margin-left: 30px;">
                    <form action="{{ route('invoice.index') }}" method="GET">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="start-date" class=" form-label m-0">Start Date</label>
                                <input type="date" name="start_date" class="form-control" style="color: #3559E0"
                                    value="{{ request('start_date') }}" />
                            </div>
                            <div class="col-md-5">
                                <label for="end-date" class=" form-label m-0">End Date</label>
                                <input type="date" name="end_date" class="form-control" style="color: #3559E0"
                                    value="{{ request('end_date') }}" />
                            </div>
                            <div class="col-md-1 p-0 btn-filter" style="margin-top: 24px">
                                <button class="btn btn-primary filter" type="submit"><i class="fas fa-filter"></i>
                                    Filter</button>
                            </div>
                            <div class="col-md-1 p-0" style="margin-top: 24px">
                                <button class="btn btn-danger reset" type="reset"><i class="fas fa-sync-alt"></i>
                                    Reset</button>
                            </div>
                        </div>
                    </form>
                    <div class="row mt-2">
                        <div class="col-md-5">
                            <label for="" class=" form-label m-0">Status</label>
                            <select id="status-filter" name="status" class="form-control" style="color: #3559E0">
                                <option value="" {{ request('status') == '' ? 'selected' : '' }}>All</option>
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Paid</option>
                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Unpaid</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label for="" class=" form-label m-0">Customer</label>
                            <select name="customerid" id="customer-select" class="form-control" style="color: #3559E0">
                                <option value="">All Customer</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        {{ request('customer') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->customername }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
            </div>
            <br>

            <div class="table-sale">

                <table class="table m-0">

                    <thead class="sticky thead">
                        <tr>
                            <th class="px-3 py-2" scope="col">#</th>
                            <th class="px-3 py-2" scope="col">Customer Name</th>
                            <th class="px-3 py-2" scope="col">Total Paid</th>
                            <th class="px-3 py-2" scope="col">Status</th>
                            <th class="px-3 py-2" scope="col">Sub Total</th>
                            <th class="px-3 py-2" scope="col">VAT</th>
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
                                    <td class="px-3" style="padding-top: 12px;" scope="row"> {{ $inv->id }} </td>
                                    <td class="px-3" style="padding-top: 12px;" scope="row">
                                        {{ @$inv->customer->customername }}
                                    </td>
                                    <td class="px-3" style="padding-top: 12px;" scope="row">
                                        {{ config('settings.currency_symbol') }} {{ $inv->total_paid }}
                                    </td>
                                    <td class="px-3" style="padding-top: 12px;" scope="row">
                                        <button
                                            class="status-toggle btn btn-sm {{ $inv->status == '1' ? 'btn-primary' : 'btn-danger' }}"
                                            data-invoice-id="{{ $inv->id }}">
                                            {{ $inv->status == '1' ? 'Paid' : 'Unpaid' }}
                                        </button>
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
                                        <div class="d-flex gap-1">
                                            @can('print invoice')
                                                <a type="button" data-bs-toggle="modal"
                                                    data-bs-target="#invoice-{{ $inv->id }}" class="btn view"
                                                    title="@lang('Print')"
                                                    style="background-color: #38E035; border: none;">
                                                    <i class="fas fa-print" style="color: #ffffff;"></i>
                                                </a>
                                            @endcan
                                            @include('sale.invoice')
                                            {{-- @role('super-admin|developer|admin')
                                                <a href="{{ route('order.edit', $inv->id) }}" type="button"
                                                    class="btn edit" title="@lang('Edit')"
                                                    style="background-color: #3559E0; border: none;">
                                                    <i class="fas fa-edit" style="color: #ffffff;"></i>
                                                </a>
                                            @endrole --}}
                                            @role('super-admin|developer|admin')
                                                <form id="deleteForm{{ $inv->id }}"
                                                    action="{{ route('invoice.destroy', ['invoice' => $inv->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn trash delete-button" type="button"
                                                        title="@lang('Delete')"
                                                        style="background-color: #FF0000;border: none;"
                                                        data-invoice-id="{{ $inv->id }}">
                                                        <i class="fas fa-trash" style="color: #ffffff;"></i>
                                                    </button>
                                                </form>
                                            @endrole
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>

                    <tfoot class="sticky footer">
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Total Paid: {{ config('settings.currency_symbol') }} {{ $totalpaid, 2 }} </th>
                            <th></th>
                            <th>Subtotal: {{ config('settings.currency_symbol') }} {{ $subtotal, 2 }} </th>
                            <th>Total VAT: {{ config('settings.currency_symbol') }} {{ $totalvat, 2 }} </th>
                            <th>Total Discount: {{ config('settings.currency_symbol') }} {{ $discount, 2 }} </th>
                            <th>Total Amount: {{ config('settings.currency_symbol') }} {{ $total_amount, 2 }} </th>
                            <th></th>
                        </tr>
                    </tfoot>

                </table>

            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            $('.status-toggle').click(function() {
                var button = $(this);
                var invoiceId = button.data('invoice-id');
                var status = button.hasClass('btn-primary') ? '0' : '1'; // toggle status

                $.ajax({
                    url: '{{ route('update-invoice-status') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        invoiceId: invoiceId,
                        status: status
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Invoice status updated successfully.',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            button.toggleClass('btn-primary btn-danger');
                            button.text(status == '1' ? 'Paid' : 'Unpaid');
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed to update invoice status.'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'An error occurred while updating the status.'
                        });
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('click', function(event) {
            if (event.target.matches('.status-toggle')) {
                var button = event.target;
                var status = button.textContent.trim() === 'Paid' ? 0 : 1;
                var invoiceId = button.dataset.invoiceId;

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('update-invoice-status') }}', true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        if (status === 1) {
                            button.textContent = 'Paid';
                            button.classList.remove('btn-danger');
                            button.classList.add('btn-primary');
                        } else {
                            button.textContent = 'Unpaid';
                            button.classList.remove('btn-primary');
                            button.classList.add('btn-danger');
                        }
                        console.log('Invoice status updated successfully.');
                        location.reload();
                    } else {
                        console.error('Error updating invoice status.');
                    }
                };
                xhr.send(JSON.stringify({
                    invoiceId: invoiceId,
                    status: status
                }));
            }
        });
    </script>
    <script>
        document.getElementById('customer-select').addEventListener('change', function() {
            var customer = this.value;
            if (customer === '') {
                window.location.href = "{{ route('invoice.index') }}";
            } else {
                window.location.href = "{{ route('invoice.index') }}?customer=" + customer;
            }
        });
    </script>
    <script>
        document.getElementById('status-filter').addEventListener('change', function() {
            var status = this.value;
            if (status === '') {
                window.location.href = "{{ route('invoice.index') }}";
            } else {
                window.location.href = "{{ route('invoice.index') }}?status=" + status;
            }
        });
    </script>
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
