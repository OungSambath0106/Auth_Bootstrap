@extends('layouts.master')
@section('page_title')
    Admin Dashboard
@endsection
<style>
    .home-dash {
        transition: 0.5s;
    }

    .home-dash:hover {
        transform: 1.5s;
        transform: translateY(-15px);
    }

    .home-dash-3 {
        transition: 0.5s;
    }

    .home-dash-3:hover {
        transform: 1.5s;
        transform: translateY(15px);
    }

    .h_17 {
        height: 17vh !important;
    }

    .flex-container {
        display: flex;
        flex-direction: column;
        min-height: 80vh;
    }

    .content {
        flex: 1;
    }

    .footer {
        position: absolute;
        text-align: center;
        padding: 10px 0 0 0;
        background-color: #3559E0 !important;
        width: 100vw;
        left: 0;
        bottom: 0;
    }
</style>
@section('content')
    <div class="container-fluid flex-container">
        <div class="content">
            <div class="mt-4 mb-4 font-weight-bolder form-label">
                <h3 style="font-weight: 700">Welcome, {{ auth()->user()->name }}</h3>
            </div>
            <!-- Content Row -->
            <div class="row">
                <!-- Total Users -->
                <div class="col-xl-3 h_17 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2 home-dash">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Users</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fas fa-user-alt fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- User Inactive -->
                <div class="col-xl-3 h_17 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2 home-dash">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Users Inactive</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $usersInactive }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fas fa-user-slash fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Menu -->
                <div class="col-xl-3 h_17 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2 home-dash">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Menus</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $menus }}</div>
                                </div>
                                <div class="col-auto">
                                    <img src="{{ asset('Image/menu.png') }}" alt="" height="42" width="32">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Customers -->
                <div class="col-xl-3 h_17 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2 home-dash">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Customers</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $customers }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Deposite Amount -->
                <div class="col-xl-3 h_17 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2 home-dash">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Deposite Amount</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fas fa-hand-holding-usd fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Find Amount -->
                <div class="col-xl-3 h_17 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2 home-dash">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Find Amount</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer card-footer text-center d-flex justify-content-around">
        <h6 class=" m-0 py-2" style="font-weight: 700; color: #F5F5F5;"><i class="fa-solid fas fa-phone-volume fa-2xs"></i> {{ config('phone.number') }}</h6>
        <h6 class=" m-0 py-2" style="font-weight: 700; color: #F5F5F5;">{{ config('copyright.text') }}</h6>
        <h6 class=" m-0 py-2" style="font-weight: 700; color: #F5F5F5;"><i class="fa-solid fas fa-map-marker-alt fa-2xs"></i> {{ config('location') }}</h6>
    </footer>
@endsection
@push('script')
    <!-- Include your JS scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script>
        $(document).ready(function() {
            // config sidebar menu
            $('#sidebar-menu li').removeClass(' menu-is-opening menu-open');
            $('#sidebar-menu li a').removeClass('active');
            $('#sidebar-menu li ul li a').removeClass('active');

            $('#menu_dashboard').addClass(' menu-is-opening menu-open');
            $('#menu_dashboard_bg').addClass('active');

        })
    </script>
@endpush
