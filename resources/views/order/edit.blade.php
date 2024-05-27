@extends('layouts.master')

@section('content')
    @push('style')
        <style>
            .card-container {
                overflow-y: auto;
                max-height: 495px;
                /* Set your desired height */
                overflow-y: scroll;
                -ms-overflow-style: none;
                /* Internet Explorer 10+ */
                scrollbar-width: none;
                /* Firefox */
            }

            .card-container::-webkit-scrollbar-thumb {
                background-color: darkgrey;
                border-radius: 10px;
            }

            .card-container::-webkit-scrollbar-track {
                background: #f1f1f1;
            }

            .card-container::-webkit-scrollbar {
                display: none;
                /* Safari and Chrome */
            }

            /* Hide spinners in Webkit browsers (e.g., Chrome, Safari) */
            input[type="number"]::-webkit-outer-spin-button,
            input[type="number"]::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            /* Hide spinners in Firefox */
            input[type="number"] {
                -moz-appearance: textfield;
            }

            /* Remove border and outline when input is focused */
            input[type="number"]:focus {
                border: none;
                outline: none;
            }

            .card-img {
                min-height: 130px !important;
                width: auto !important;
            }
        </style>
    @endpush

    <div class="container-fluid content">
        <div class="row">
            <div class="col-md-8">
                <div class="col-12">
                    <ul class="nav nav-pills d-inline-flex mt-4" id="myTab">
                        @foreach ($menuTypes as $menuType)
                            <li class="nav-item">
                                <a class="categories pill {{ $loop->first ? 'active' : '' }}" data-bs-toggle="pill"
                                    href="#{{ $menuType->id }}">
                                    <span class="nav-text">{{ $menuType->name }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="tab-content mt-4">
                    @foreach ($menuTypes as $menuType)
                        <div id="{{ $menuType->id }}" class="tab-pane fade show p-0 {{ $loop->first ? 'active' : '' }}">
                            <div class="card-container justify-content-start">
                                @foreach ($menus->where('menutype_id', $menuType->id) as $menu)
                                    <div class="card card-menu">
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-end text-center">
                                                <div class="container-item m-3">
                                                    <button class="cart-button" data-id="{{ $menu->id }}">
                                                        <i class="fa-solid fas fa-shopping-cart add-item"
                                                            style="color: #ffffff;"></i>
                                                        <span class="item-counter" style="display: none;"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 d-flex justify-content-center">
                                                @if ($menu->image)
                                                    <img class="card-img"
                                                        src="{{ asset('storage/uploads/menus_photo/' . $menu->image) }}"
                                                        alt="{{ $menu->menuname }}" height="130">
                                                @else
                                                    <img class="card-img" src="{{ asset('storage/uploads/default.png') }}"
                                                        alt="Default Image">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-7 title-price">{{ $menu->menuname }}</div>
                                                <div class="col-md-5 title-price justify-content-start">
                                                    <span>{{ config('settings.currency_symbol') }}
                                                        {{ $menu->price }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4 p-0 pt-3">
                <form action="{{ route('order.update', $invoice->id) }}" method="POST" id="frmCh">
                    @csrf
                    @method('PUT')
                    <div class="subnav-container">
                        <div class="subnav">
                            <div class="invoicenum row d-flex">
                                <input type="text" class="form-control" value="{{ $customer->customername }}" readonly
                                    style="color: #3559E0;">
                                <input type="hidden" name="customerid" value="{{ $customer->id }}">
                                <span class="col-4">Order #{{ $invoice->id }}</span>
                            </div>
                            <div class="row ordernum">
                                <div class="col-3">
                                </div>
                                <div class="col-3 px-2">
                                    <span class="checkouttitle">
                                        Title
                                    </span>
                                </div>
                                <div class="col-3 pr-0 text-center">
                                    <Span class="checkouttitle">
                                        Quantity
                                    </Span>
                                </div>
                                <div class="col-3 px-4">
                                    <span class="checkouttitle">
                                        Price
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="checkout-content">

                    </div>
                    <div class="checkout-bill p-3 mt-1">
                        <div class="row">
                            <div class="col-6 mb-1">
                                <span class="text-subtotal">Subtotal</span>
                            </div>
                            <div class="col-6 text-end">
                                <span class="subtotal">{{ config('settings.currency_symbol') }} 0.00</span>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-6">
                                <span class="text-tax">VAT</span>
                            </div>
                            <div class="col-6 text-end">
                                <input type="hidden" name="vat" class="" value="10">
                                <input type="hidden" name="vat_amount" class="" value="0">
                                <span class="vat">{{ config('settings.currency_symbol') }} 0.00</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <span class="text-discount">Discount</span>
                            </div>
                            <div class="col-6 text-end">
                                <input type="hidden" name="discount" class="" value="15">
                                <input type="hidden" name="discount_amount" class="" value="0">
                                <span class="discount">{{ config('settings.currency_symbol') }} 0.00</span>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <span class="text-total">Total</span>
                            </div>
                            <div class="col-6 text-end">
                                <span class="total">{{ config('settings.currency_symbol') }} 0.00</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 gap-2 d-flex pt-3">
                                <button type="button" class="btn btn-custom d-block w-100 pose finish text-all checkout"
                                    data-bs-toggle="modal" data-bs-target="#checkout">Checkout</button>
                                <button type="button" class="btn btn-custom d-block w-100 pose finish text-all clear"
                                    data-bs-target="#clear">Clear All</button>
                            </div>
                        </div>
                    </div>
                    @include('order.create')
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Show only Ice Coffee tab pane by default
            $('#icecoffee').addClass('show active');

            // Listen for click events on navbar items
            $('.categories').on('click', function(e) {
                e.preventDefault(); // Prevent default behavior of link

                // Hide all tab panes
                $('.tab-pane').removeClass('show active');

                // Get the target tab pane ID from href attribute
                var targetTab = $(this).attr('href');

                // Show the corresponding tab pane
                $(targetTab).addClass('show active');
            });
        });

        $(document).on('click', '.clear', function() {
            // Clear all card-checkout elements
            $('.card-checkout').remove();

            $('.checkout-bill').find('.subtotal').text('{{ config('settings.currency_symbol') }} 0.00');
            $('.checkout-bill').find('.vat').text('{{ config('settings.currency_symbol') }} 0.00');
            $('.checkout-bill').find('.discount').text('{{ config('settings.currency_symbol') }} 0.00');
            $('.checkout-bill').find('.total').text('{{ config('settings.currency_symbol') }} 0.00');
            $('.checkout-bill').find('input[name="vat"]').val(10);
            $('.checkout-bill').find('input[name="vat_amount"]').val(0);
            $('.checkout-bill').find('input[name="discount"]').val(15);
            $('.checkout-bill').find('input[name="discount_amount"]').val(0);
        });
    </script>



    <script>
        $(document).ready(function() {
            const currencySymbol = "{{ config('settings.currency_symbol') }}"; // Store the currency symbol

            function recalculateAll() {
                let subtotal = 0.00;

                // Calculate subtotal by summing up all the item total prices
                $('.total-price').each(function() {
                    subtotal += parseFloat($(this).text());
                });

                // Calculate vat and discount
                let vat = subtotal * 0.1;
                let discount = subtotal * 0.15;
                let total = subtotal + vat - discount;

                // Update the values in the checkout bill section with currency symbol
                $('.subtotal').text(currencySymbol + subtotal.toFixed(2));
                $('.vat').text(currencySymbol + vat.toFixed(2));
                $('input[name=vat_amount]').val(vat.toFixed(2));
                $('.discount').text(currencySymbol + discount.toFixed(2));
                $('input[name=discount_amount]').val(discount.toFixed(2));
                $('.total').text(currencySymbol + total.toFixed(2));
            }

            $('.cart-button').on('click', function() {
                // Extract data from the card
                var id = $(this).data('id');
                var card = $(this).closest('.card-menu');
                var imageSrc = card.find('.card-img').attr('src');
                var menuName = card.find('.title-price').first().text().trim();
                var truncatedMenuName = menuName.substring(0, 10); // Get the first 10 characters
                var price = parseFloat(card.find('.title-price').last().text().trim().replace(/[^0-9.-]+/g,
                    ""));

                if ($('.checkout-content').find(`#menu_${id}`).length == 1) {
                    console.log('hwllo');
                    var current_qty = $('.checkout-content').find(`#menu_${id} .counter-value`).val();
                    // .counter-value
                    console.log(current_qty);
                    var newqty = parseInt(current_qty) + 1;
                    $('.checkout-content').find(`#menu_${id} .counter-value`).val(newqty);
                    $('.checkout-content').find(`#menu_${id} .counter-value`).trigger('input');
                } else {
                    var checkoutItemHtml = `
            <div class="card-checkout" id="menu_${id}">
                <div class="row" style="height: 95px;">
                    <div class="col-3 d-flex justify-content-start align-items-start">
                        <div class="img-container d-flex justify-content-center align-items-center">
                            <img class="card-img-checkout" src="${imageSrc}" height="20">
                        </div>
                    </div>
                    <div class="col-3 p-0">
                        <div class="row pt-3">
                            <input type="hidden" name="menus[${id}][id]" class="" value="${id}">
                            <div class="checkout-title">${truncatedMenuName}</div>
                            <input type="hidden" name="menus[${id}][name]" class="" value="${truncatedMenuName}" min="0">
                            <div class="checkout-title item-price" data-price="${price}">${currencySymbol} ${price.toFixed(2)}</div>
                            <input type="hidden" name="menus[${id}][price]" class="" value="${price}" min="0">
                        </div>
                        
                    </div>
                    <div class="col-3 d-flex justify-content-center align-items-center p-0">
                        <div class="quantity">
                            <button class="counter-btn minus" type="button">
                                <i class="fa-solid fa fa-minus fa-3xs" style="color: #ffffff;"></i>
                            </button>
                            <input type="number" name="menus[${id}][qty]" class="counter-value" value="1" min="0">
                            <button class="counter-btn plus" type="button">
                                <i class="fa-solid fa fa-plus fa-3xs" style="color: #ffffff;"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="row d-flex justify-content-end align-items-center p-2">
                            <div class="col-auto">
                                <button class="btn-delete d-flex justify-content-center align-items-center float-right">
                                    <i class="fa-solid fas fa-trash-alt fa-xs" style="color: #ffffff;"></i>
                                </button>
                            </div>
                            <div class="ineach pt-2">
                                <span class="price">${currencySymbol}</span>
                                <span class="total-price">${price.toFixed(2)}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

                    // Append the new item to the checkout content
                    $('.checkout-content').append(checkoutItemHtml);
                }

                // Create the new checkout item HTML


                // Recalculate all values
                recalculateAll();
            });

            // Handle delete button click
            $(document).on('click', '.btn-delete', function() {
                $(this).closest('.card-checkout').remove();
                recalculateAll();
            });

            // Handle quantity change on button click
            $(document).on('click', '.counter-btn', function(event) {
                event.stopPropagation(); // Stop event propagation to prevent triggering the checkout action

                var input = $(this).siblings('.counter-value');
                var currentValue = parseInt(input.val());

                if ($(this).hasClass('plus')) {
                    input.val(currentValue + 1);
                } else if ($(this).hasClass('minus')) {
                    if (currentValue > 0) {
                        input.val(currentValue - 1);
                    }
                }

                // Trigger input change
                input.trigger('input');
            });

            // Recalculate total on direct input change
            $(document).on('input', '.counter-value', function() {
                var input = $(this);
                var cardCheckout = input.closest('.card-checkout');
                var price = parseFloat(cardCheckout.find('.item-price').data('price'));
                var quantity = parseInt(input.val());
                if (isNaN(quantity) || quantity < 0) {
                    quantity = 0;
                    input.val(quantity);
                }
                var totalPrice = (price * quantity).toFixed(2);
                cardCheckout.find('.total-price').text(totalPrice);

                recalculateAll();
            });

            // Handle checkout button click
            $(document).on('click', '.checkout', function() {
                var customer = $('.select2').val();
                var subtotal = parseFloat($('.subtotal').text().replace(currencySymbol, '').trim());
                var totalQty = 0;

                $('.counter-value').each(function() {
                    totalQty += parseInt($(this).val());
                });

                var total = parseFloat($('.total').text().replace(currencySymbol, '').trim());

                $('#frmCh input[name="subtotal"]').val(subtotal.toFixed(2));
                $('#frmCh input[name="total_qty"]').val(totalQty);
                $('#frmCh input[name="customerid"]').val(customer);
                $('#frmCh input[name="total"]').val(total.toFixed(2));

                $('#checkout').modal('show');
            });

            // Validate total paid input
            $(document).on('input', '#input-total', function() {
                var totalInput = parseFloat($(this).val());
                var total = parseFloat($('.total').text().replace(currencySymbol, '').trim());

                if (totalInput > total) {
                    $('#max-value').removeClass('d-none').text(
                        'Total paid amount cannot exceed the total!');
                    $(this).val(total.toFixed(2));
                } else {
                    $('#max-value').addClass('d-none').text('');
                }

                if (totalInput > 0) {
                    $('#max-value').removeClass('d-none').text(
                        'Total paid amount cannot exceed the total!');
                    $(this).val(total.toFixed(2));
                } else {
                    $('#max-value').addClass('d-none').text('');
                }
            });

            recalculateAll();
        });
    </script>

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection
