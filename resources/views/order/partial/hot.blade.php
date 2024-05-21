<div class="card-container justify-content-start">
    @foreach($menus as $menu)
        <div class="card card-menu">
            <div class="row">
                <div class="col-12 d-flex justify-content-end text-center">
                    <div class="container-item m-3">
                        <button class="cart-button">
                            <i class="fa-solid fas fa-shopping-cart add-item" style="color: #ffffff;"></i>
                            <span class="item-counter" style="display: none;"></span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    @if($menu->image)
                        <img class="card-img" src="{{ asset('storage/uploads/menus_photo/' . $menu->image) }}" alt="{{ $menu->menuname }}" height="130">
                    @else
                        <img class="card-img" src="{{ asset('storage/uploads/default.png') }}" alt="Default Image">
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8 title-price">{{ $menu->menuname }}</div>
                    <div class="col-4 title-price d-flex justify-content-end"><span>{{ config('settings.currency_symbol') }} {{ $menu->price }}</span></div>
                </div>
                <div class="row pt-2">
                    <div class="col-6 ice-sugar">Ice</div>
                    <div class="col-6 ice-sugar">Sugar</div>
                </div>
                <div class="row percentage">
                    <div class="col-6 d-flex">
                        <div class="ice">
                            <span>0%</span>
                        </div>
                        <div class="ice">
                            <span>50%</span>
                        </div>
                        <div class="ice">
                            <span>100%</span>
                        </div>
                    </div>
                    <div class="col-6 d-flex">
                        <div class="sugar">
                            <span>0%</span>
                        </div>
                        <div class="sugar">
                            <span>50%</span>
                        </div>
                        <div class="sugar">
                            <span>100%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>