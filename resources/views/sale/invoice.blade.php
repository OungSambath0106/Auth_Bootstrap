<style>
    hr {
        border: solid 1px #3559E0;
    }

    .scrollable {
        overflow-y: auto;
        overflow-y: scroll;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .scrollable::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .scrollable::-webkit-scrollbar {
        display: none;
    }
</style>

<div class="modal fade scrollable" id="invoice-{{ $inv->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" id="invoiceSection-{{ $inv->id }}">
                <div class="list-group-item card">
                    <div class="card-header border-bottom-0">
                        <h5 class="mt-2 form-label"><b>INVOICE #{{ $inv->id }}</b></h5>
                        <h6 class="mt-2 form-label"><b>Date {{ $inv->created_at->format('M / d / Y') }}</b></h6>
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
                                            @if ($inv->invoiceDetails->isNotEmpty())
                                                @foreach ($inv->invoiceDetails as $detail)
                                                    <div class="row">
                                                        <div class="col-6 mb-1">
                                                            <span
                                                                class="form-label">{{ $detail->menu->menuname }}</span>
                                                        </div>
                                                        <div class="col-2 mb-1 text-center">
                                                            <span class="form-label">{{ $detail->orderquantity }}</span>
                                                        </div>
                                                        <div class="col-4 mb-1 text-end">
                                                            <span class="form-label">
                                                                {{ config('settings.currency_symbol') }}
                                                                {{ number_format($detail->orderprice * $detail->orderquantity, 2) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p>No details found for this invoice.</p>
                                            @endif
                                        </div>
                                        <div class="body-container">
                                            <div class="row">
                                                <div class="col-6 text-start">
                                                    <label for="subtotal" class="form-label">Subtotal</label>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <label for="subtotal"
                                                        class="form-label">{{ config('settings.currency_symbol') }}
                                                        {{ $inv->subtotal }}</label>
                                                </div>
                                                <div class="col-6 text-start">
                                                    <label for="vat_amount" class="form-label">VAT Amount</label>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <label for="vat_amount"
                                                        class="form-label">{{ config('settings.currency_symbol') }}
                                                        {{ $inv->vat_amount }}</label>
                                                </div>
                                                <div class="col-6 text-start">
                                                    <label for="discount_amount" class="form-label">Discount
                                                        Amount</label>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <label for="discount_amount"
                                                        class="form-label">{{ config('settings.currency_symbol') }}
                                                        {{ $inv->discount_amount }}</label>
                                                </div>
                                                <hr class="w-100">
                                                <div class="col-6">
                                                    <label for="total" class="form-label">Grand Total ( USD )</label>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <label for="total"
                                                        class="form-label">{{ config('settings.currency_symbol') }}
                                                        {{ $inv->total }}</label>
                                                </div>
                                                <div class="col-6">
                                                    <label for="total" class="form-label">Grand Total ( KHR )</label>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <label for="total" class="form-label">
                                                        <span style="font-size: 1rem">៛</span>  
                                                        {{ number_format($inv->total * 4000, 0, '', ',') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary print"
                    onclick="printInvoice('{{ $inv->id }}')">Print</button>
                <a href="{{ route('invoice.index') }}" type="button" class="btn btn-danger"
                    data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>

<script>
    function printInvoice(invoiceId) {
        var printContents = document.getElementById('invoiceSection-' + invoiceId).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
        // window.location.reload();
    }
</script>
