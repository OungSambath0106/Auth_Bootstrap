@extends('layouts.master')

@section('content')
<style>
    .form-control {
        btransaction-radius: 0;
    }

    .pagination {
        margin-top: 20px;
    }

    .pagination a p {
        color: #333;
        text-decoration: none;
        padding: 5px 10px;
        border: 1px solid #ccc;
        margin-right: 5px;
    }

    .pagination a:hover {
        background-color: #f5f5f5;
    }

    .pagination .disabled {
        color: #999;
        pointer-events: none;
    }

    #pagination-select {
        width: 65px;
    }

</style>
<div class="card">
    <div class="card-body">
        <div class="row">
            <!-- <div class="col-md-3"></div> -->
            <div class="col-md-12">
                <form action="{{ route('transaction.index') }}" method="GET">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="start-date">Start Date</label>
                            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}" />
                        </div>
                        <div class="col-md-5">
                            <label for="end-date">End Date</label>
                            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}" />
                        </div>
                        <div class="col-md-2" style="margin-top: 30px">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-filter"></i> Filter</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-5">
                        <label for="">Status</label>
                        <select id="status-filter" name="status" class="form-control">
                            <option value="" {{ request('status')==''?'selected':'' }}>All</option>
                            <option value="due" {{ request('status')=='due'?'selected':'' }}>Due</option>
                            <option value="partial" {{ request('status')=='partial'?'selected':'' }}>Partial</option>
                            <option value="paid" {{ request('status')=='paid'?'selected':'' }}>Paid</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="">Customer</label>
                        <select name="customer_id" id="customer-select" class="form-control">
                            <option value="">Select customer...</option>
                            @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}" {{ request('customer')== $customer->id ? 'selected' : '' }}>
                                {{ $customer->first_name }} {{ $customer->last_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>
        </div>
        <br>
        <table class="table table-btransactioned table-hover table-bordered">
            <thead class="thead-dark text-uppercase">
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Table</th>
                    <th>Total Paid</th>
                    <th>Total Due</th>
                    <th>Status</th>
                    <th>Discount</th>
                    <th>Subtotal</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }} </td>
                    <td>{{ @$transaction->customer->first_name }} {{ @$transaction->customer->last_name }}</td>
                    <td>{{ @$transaction->table->table_name }}</td>
                    <td>{{ config('settings.currency_symbol') }} {{ $transaction->total_paid }}</td>
                    <td>{{ config('settings.currency_symbol') }} {{ $transaction->total_due }}</td>
                    <td>
                        @if($transaction->status == 'due')
                        <span class=" btn btn-sm btn-warning">Due</span>
                        @elseif($transaction->status == 'partial')
                        <span class=" btn btn-sm btn-info text-white">Partial</span>
                        @else
                        <span class=" btn btn-sm btn-success">Paid</span>
                        @endif
                    </td>
                    <td>{{ config('settings.currency_symbol') }} {{ $transaction->discount ?? 0 }}</td>
                    <td>{{ config('settings.currency_symbol') }} {{ $transaction->subtotal }}</td>
                    <td>{{ config('settings.currency_symbol') }} {{ $transaction->total }}</td>
                    <td>
                        <div style="display:flex;">
                            <span>
                                <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#staticBackdrop"><i class="fas fa-edit"></i></a>
                            </span>
                            <span>
                                <a href="" class="btn btn-secondary btn-sm ml-2"><i class="fas fa-eye"></i></a>
                            </span>
                            <span>
                                <form id="deleteForm{{ $transaction->id }}" action="{{ route('transaction.destroy', ['transaction' => $transaction->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-md text-uppercase btn-sm ml-2 delete-button" type="button" data-transaction-id="{{ $transaction->id }}"> <i class="fas fa-trash"></i></button>
                                </form>
                            </span>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Total Paid: {{ config('settings.currency_symbol') }} {{$totalpaid,2}}</th>
                    <th>Total Paid: {{ config('settings.currency_symbol') }} {{$total_due,2}}</th>
                    <th></th>
                    <th>Total Discount: {{ config('settings.currency_symbol') }} {{$discount,2}}</th>
                    <th>Subtotal: {{ config('settings.currency_symbol') }} {{$subtotal,2}}</th>
                    <th>Total Paid: {{ config('settings.currency_symbol') }} {{$total_amount,2}}</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        {{-- <div class="pagination">
            <a href="{{ $transactionss->previousPageUrl() }}" class="{{ $transactionss->onFirstPage() ? 'disabled' : '' }} mr-2">&laquo; Previous</a>
            <p class="ml-2">Page {{ $transactionss->currentPage() }} of {{ $transactionss->lastPage() }}</p>
            <p class="ml-2">Items: {{ $transactionss->count() }} / {{ $transactionss->total() }}</p>

            <a href="{{ $transactionss->nextPageUrl() }}" class="{{ !$transactionss->hasMorePages() ? 'disabled' : '' }} ml-2">Next &raquo;</a>
        </div> --}}
        <p class="mt-2 font-weight-bold">Transaction: {{ $transactionss }} entries</p>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('.delete-button').on('click', function(e) {
            var transactionId = $(this).data('transaction-id');
            Swal.fire({
                title: "Are you sure?"
                , text: "You won't be able to revert this!"
                , icon: "warning"
                , showCancelButton: true
                , confirmButtonColor: "#3085d6"
                , cancelButtonColor: "#d33"
                , confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#deleteForm' + transactionId).submit();
                }
            });
        });
    });

</script>
<script>
    document.getElementById('customer-select').addEventListener('change', function() {
        var customer = this.value;
        if (customer === '') {
            window.location.href = "{{ route('transaction.index') }}";
        } else {
            window.location.href = "{{ route('transaction.index') }}?customer=" + customer;
        }
    });

</script>
<script>
    document.getElementById('status-filter').addEventListener('change', function() {
        var status = this.value;
        if (status === '') {
            window.location.href = "{{ route('transaction.index') }}";
        } else {
            window.location.href = "{{ route('transaction.index') }}?status=" + status;
        }
    });

</script>
@endsection
