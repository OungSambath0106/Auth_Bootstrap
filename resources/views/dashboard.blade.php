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

    .h_17{
        height: 17vh !important;
    }

</style>
@section('content')
<div class="container-fluid">
    <div class=" mt-4 mb-4 form-label">
        <h3>Welcome, {{ auth()->user()->name }}</h3>
    </div>
    <!-- Content Row -->
    {{-- @if (auth()->user()->can('dashboard')) --}}
    <div class="row">
        <!-- Income -->
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
                            <i class="fa-solid fa-user-group fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 h_17 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2 home-dash">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Menu</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $menus }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
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
        {{-- Deposite Amount --}}
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
                            <i class="fa-solid fa-hand-holding-dollar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Find Amount --}}
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
                            <i class="fa-solid fa-circle-dollar-to-slot fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @endif --}}
</div>
@endsection
@push('script')
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
