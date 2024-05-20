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
        </style>
    @endpush
    <div class="container-fluid content">
        <div class="row">
            <div class="col-md-8">
                <div class="col-12">
                    <ul class="nav nav-pills d-inline-flex mt-4" id="myTab">
                        <li class="nav-item">
                            <a class="categories pill active" data-bs-toggle="pill" href="#icecoffee">
                                <span>Ice Coffee</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="categories pill" data-bs-toggle="pill" href="#hotcoffee">
                                <span>Hot Coffee</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="categories pill" data-bs-toggle="pill" href="#tea">
                                <span>Tea</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="categories pill" data-bs-toggle="pill" href="#smoothie">
                                <span>Smoothie</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="categories pill" data-bs-toggle="pill" href="#dessert">
                                <span>Dessert</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content mt-4">
                    <div id="icecoffee" class="tab-pane fade show p-0 active">
                        @include('menu-type.ice')
                    </div>
                    <div id="hotcoffee" class="tab-pane fade show p-0">
                        @include('menu-type.hot')
                    </div>
                    <div id="tea" class="tab-pane fade show p-0">
                        @include('menu-type.tea')
                    </div>
                    <div id="smoothie" class="tab-pane fade show p-0">
                        @include('menu-type.smoothie')
                    </div>
                    <div id="dessert" class="tab-pane fade show p-0">
                        @include('menu-type.dessert')
                    </div>
                </div>
            </div>
            <div class="col-md-4 p-0">
                <div class="subnav-container">
                    <div class="subnav">
                        <div class="invoicenum"><span>Order #1</span></div>
                        <div class="row ordernum">
                            <div class="col-4">
                            </div>
                            <div class="col-3 p-0">
                                <span class="checkouttitle">
                                    Title
                                </span>
                            </div>
                            <div class="col-2 p-0">
                                <Span class="checkouttitle">
                                    Quantity
                                </Span>
                            </div>
                            <div class="col-3">
                                <span class="checkouttitle">
                                    Price
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="checkout-content mt-2">
                    <div class="card-checkout mt-2">
                        <div class="row" style="height: 120px;">
                            <div class="col-4 d-flex justify-content-center align-items-center p-0">
                                <div class="img-container d-flex justify-content-center align-items-center">
                                    <img class="card-img-checkout" src="{{ asset('Image/Ice Coffee.png') }}">
                                </div>
                            </div>
                            <div class="col-3 p-0">
                                <div class="row pt-2">
                                    <div class="checkout-title">Green Tea</div>
                                    <div class="checkout-title item-price">$ 2.00</div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-5 icetitle">Ice</div>
                                    <div class="col-5 sugartitle">Sugar</div>
                                    {{-- <div class="col-2"></div> --}}
                                </div>
                                <div class="row percentage">
                                    <div class="col-5 d-flex ">
                                        <div class="iceactive">
                                            <span>50%</span>
                                        </div>
                                    </div>
                                    <div class="col-5 d-flex">
                                        <div class="sugaractive">
                                            <span>50%</span>
                                        </div>
                                    </div>
                                    <div class="col-2"></div>
                                </div>
                            </div>
                            <div class="col-2 d-flex justify-content-center align-items-center p-0">
                                <div class="quantity">
                                    <button class="counter-btn minus">
                                        <i class="fa-solid fa fa-minus fa-3xs" style="color: #ffffff;"></i>
                                    </button>
                                    <input type="number" class="counter-value" value="0" min="0">
                                    <button class="counter-btn plus">
                                        <i class="fa-solid fa fa-plus fa-3xs" style="color: #ffffff;"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="row d-flex justify-content-end align-items-center p-2">
                                    <div class="col-auto">
                                        <button iii
                                            class="btn-delete d-flex justify-content-center align-items-center float-right">
                                            <i class="fa-solid fas fa-trash-alt fa-xs" style="color: #ffffff;"></i>
                                        </button>
                                    </div>
                                    <div class="ineach pt-2"><span class="price">$ 0.00</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-checkout mt-2">
                        <div class="row" style="height: 120px;">
                            <div class="col-4 d-flex justify-content-center align-items-center p-0">
                                <div class="img-container d-flex justify-content-center align-items-center">
                                    <img class="card-img-checkout" src="{{ asset('Image/Ice Coffee.png') }}">
                                </div>
                            </div>
                            <div class="col-3 p-0">
                                <div class="row pt-2">
                                    <div class="checkout-title">Green Tea</div>
                                    <div class="checkout-title item-price">$ 2.00</div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-5 icetitle">Ice</div>
                                    <div class="col-5 sugartitle">Sugar</div>
                                    {{-- <div class="col-2"></div> --}}
                                </div>
                                <div class="row percentage">
                                    <div class="col-5 d-flex ">
                                        <div class="iceactive">
                                            <span>50%</span>
                                        </div>
                                    </div>
                                    <div class="col-5 d-flex">
                                        <div class="sugaractive">
                                            <span>50%</span>
                                        </div>
                                    </div>
                                    <div class="col-2"></div>
                                </div>
                            </div>
                            <div class="col-2 d-flex justify-content-center align-items-center p-0">
                                <div class="quantity">
                                    <button class="counter-btn minus">
                                        <i class="fa-solid fa fa-minus fa-3xs" style="color: #ffffff;"></i>
                                    </button>
                                    <input type="number" class="counter-value" value="0" min="0">
                                    <button class="counter-btn plus">
                                        <i class="fa-solid fa fa-plus fa-3xs" style="color: #ffffff;"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="row d-flex justify-content-end align-items-center p-2">
                                    <div class="col-auto">
                                        <button iii
                                            class="btn-delete d-flex justify-content-center align-items-center float-right">
                                            <i class="fa-solid fas fa-trash-alt fa-xs" style="color: #ffffff;"></i>
                                        </button>
                                    </div>
                                    <div class="ineach pt-2"><span class="price">$ 0.00</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-checkout mt-2">
                        <div class="row" style="height: 120px;">
                            <div class="col-4 d-flex justify-content-center align-items-center p-0">
                                <div class="img-container d-flex justify-content-center align-items-center">
                                    <img class="card-img-checkout" src="{{ asset('Image/Ice Coffee.png') }}">
                                </div>
                            </div>
                            <div class="col-3 p-0">
                                <div class="row pt-2">
                                    <div class="checkout-title">Green Tea</div>
                                    <div class="checkout-title item-price">$ 2.00</div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-5 icetitle">Ice</div>
                                    <div class="col-5 sugartitle">Sugar</div>
                                    {{-- <div class="col-2"></div> --}}
                                </div>
                                <div class="row percentage">
                                    <div class="col-5 d-flex ">
                                        <div class="iceactive">
                                            <span>50%</span>
                                        </div>
                                    </div>
                                    <div class="col-5 d-flex">
                                        <div class="sugaractive">
                                            <span>50%</span>
                                        </div>
                                    </div>
                                    <div class="col-2"></div>
                                </div>
                            </div>
                            <div class="col-2 d-flex justify-content-center align-items-center p-0">
                                <div class="quantity">
                                    <button class="counter-btn minus">
                                        <i class="fa-solid fa fa-minus fa-3xs" style="color: #ffffff;"></i>
                                    </button>
                                    <input type="number" class="counter-value" value="0" min="0">
                                    <button class="counter-btn plus">
                                        <i class="fa-solid fa fa-plus fa-3xs" style="color: #ffffff;"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="row d-flex justify-content-end align-items-center p-2">
                                    <div class="col-auto">
                                        <button iii
                                            class="btn-delete d-flex justify-content-center align-items-center float-right">
                                            <i class="fa-solid fas fa-trash-alt fa-xs" style="color: #ffffff;"></i>
                                        </button>
                                    </div>
                                    <div class="ineach pt-2"><span class="price">$ 0.00</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="checkout-bill">
                    <div class="row">
                        <div class="col-6 mb-1">
                            <span class="text-subtotal">Subtotal</span>
                        </div>
                        <div class="col-6 text-end">
                            <span class="subtotal">$ 0.00</span>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-6">
                            <span class="text-tax">Tax</span>
                        </div>
                        <div class="col-6 text-end">
                            <span class="tax">$ 0.00</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <span class="text-discount">Discount</span>
                        </div>
                        <div class="col-6 text-end">
                            <span class="discount">$ 0.00</span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <span class="text-total">Total</span>
                        </div>
                        <div class="col-6 text-end">
                            <span class="total">$ 0.00</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 pt-3">
                            <a href="#" class="btn btn-custom d-block w-100">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @push('script')
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
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Function to update tax, discount, and total
                    function updateTaxDiscountTotal(subtotal) {
                        const taxRate = 0.1;
                        const tax = subtotal * taxRate;
                        document.querySelector('.tax').textContent = '$ ' + tax.toFixed(2);

                        const discountRate = 0.15;
                        const discount = subtotal * discountRate;
                        document.querySelector('.discount').textContent = '$ ' + discount.toFixed(2);

                        const total = subtotal + tax - discount;
                        document.querySelector('.total').textContent = '$ ' + total.toFixed(2);
                    }

                    const subtotalElement = document.querySelector('.subtotal');
                    const initialSubtotal = parseFloat(subtotalElement.textContent.replace('$', ''));
                    updateTaxDiscountTotal(initialSubtotal);

                    const minusBtns = document.querySelectorAll('.minus');
                    const plusBtns = document.querySelectorAll('.plus');

                    // Function to update price and subtotal
                    function updatePriceAndSubtotal(element) {
                        const counterValue = element.closest('.card-checkout').querySelector('.counter-value');
                        const itemPriceElement = element.closest('.card-checkout').querySelector('.item-price');
                        const priceElement = element.closest('.card-checkout').querySelector('.price');

                        let price = parseFloat(counterValue.value) * parseFloat(itemPriceElement.textContent.replace(
                            '$', ''));
                        priceElement.textContent = '$ ' + price.toFixed(2);

                        let total = 0;
                        document.querySelectorAll('.price').forEach(function(price) {
                            total += parseFloat(price.textContent.replace('$', ''));
                        });
                        subtotalElement.textContent = '$ ' + total.toFixed(2);
                        updateTaxDiscountTotal(total);
                    }

                    minusBtns.forEach(function(button) {
                        button.addEventListener('click', function() {
                            const counterValue = button.closest('.card-checkout').querySelector(
                                '.counter-value');
                            if (parseInt(counterValue.value) > 0) {
                                counterValue.value = parseInt(counterValue.value) - 1;
                                updatePriceAndSubtotal(button);
                            }
                        });
                    });

                    plusBtns.forEach(function(button) {
                        button.addEventListener('click', function() {
                            const counterValue = button.closest('.card-checkout').querySelector(
                                '.counter-value');
                            counterValue.value = parseInt(counterValue.value) + 1;
                            updatePriceAndSubtotal(button);
                        });
                    });
                });
            </script>
        @endpush
    @endsection
