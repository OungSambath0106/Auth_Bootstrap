@extends('layouts.master')

@section('content')
    <style>
        .border-0 {
            background: none;
        }

        .card-header {
            background: none;
        }

        hr {
            color: #3559E0;
        }

        .center-container {
            display: flex;
            justify-content: center;
            height: 100vh;
            /* Set the height to full viewport height */
        }

        .scrollable-list-group {
            max-height: 80vh;
            /* Set a maximum height for the list group */
            overflow-y: auto;
            /* Enable vertical scrolling */
            overflow-y: scroll;
            -ms-overflow-style: none;
            /* Internet Explorer 10+ */
            scrollbar-width: none;
            /* Firefox */
        }

        .scrollable-list-group::-webkit-scrollbar-thumb {
            background-color: darkgrey;
            border-radius: 10px;
        }

        .scrollable-list-group::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .scrollable-list-group::-webkit-scrollbar {
            display: none;
            /* Safari and Chrome */
        }
    </style>

    <div class="center-container scrollable-list-group">
        <div class="list-group p-3 mt-2 col-md-4">
            <form id="invoiceSection" action="{{ route('invoice.show', $invoice->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="list-group-item card">
                    <div class="card-header border-bottom-0">
                        <h5 class="mt-2 form-label"><b>INVOICE #{{ $invoice->id }}</b></h5>
                        <h6 class="mt-2 form-label"><b>Date {{ $invoice->created_at->format('M / d / Y') }}</b></h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row justify-content-between">
                                        <div class="nav-container">
                                            <div class="row">
                                                <div class="col-6">
                                                    <span class="form-label">Title</span>
                                                </div>
                                                <div class="col-2 text-center">
                                                    <span class="form-label">Qty</span>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <span class="form-label">Price</span>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="body-container mb-5">
                                            @foreach ($menus as $menu)
                                                @php
                                                    $menuDetail = $invoiceDetails->firstWhere('menuid', $menu->id);
                                                @endphp
                                                @if ($menuDetail && $menuDetail->orderquantity !== null && $menuDetail->orderprice !== null)
                                                    <div class="row">
                                                        <div class="col-6 mb-1">
                                                            <span class="form-label">{{ $menu->menuname }}</span>
                                                        </div>
                                                        <div class="col-2 mb-1 text-center">
                                                            <span class="form-label">{{ $menuDetail->orderquantity }}</span>
                                                        </div>
                                                        <div class="col-4 mb-1 text-end">
                                                            <span
                                                                class="form-label">{{ config('settings.currency_symbol') }}
                                                                {{ $menuDetail->orderprice }}</span>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="body-container">
                                            <div class="row">
                                                <div class="col-6 text-start">
                                                    <label for="subtotal" class="form-label">Subtotal</label>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <label for="subtotal"
                                                        class="form-label">{{ config('settings.currency_symbol') }}
                                                        {{ $invoice->subtotal }}</label>
                                                </div>
                                                <div class="col-6 text-start">
                                                    <label for="vat_amount" class="form-label">VAT</label>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <label for="vat_amount"
                                                        class="form-label">{{ config('settings.currency_symbol') }}
                                                        {{ $invoice->vat_amount }}</label>
                                                </div>
                                                <div class="col-6 text-start">
                                                    <label for="discount_amount" class="form-label">Discount</label>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <label for="discount_amount"
                                                        class="form-label">{{ config('settings.currency_symbol') }}
                                                        {{ $invoice->discount_amount }}</label>
                                                </div>
                                                <hr class="w-100">
                                                <div class="col-6">
                                                    <label for="total" class="form-label">Total</label>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <label for="total"
                                                        class="form-label">{{ config('settings.currency_symbol') }}
                                                        {{ $invoice->total }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-12 gap-2 d-flex pt-3">
                    <button type="button" class="btn btn-custom d-block w-100 pose finish text-all print"
                        onclick="printInvoice()">Print</button>
                    <a type="button" href="{{ route('invoice.index') }}"
                        class="btn btn-custom d-block w-100 pose finish text-all">Back</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printInvoice() {
            var printContents = document.getElementById('invoiceSection').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
            window.location.reload();
        }
    </script>
@endsection
