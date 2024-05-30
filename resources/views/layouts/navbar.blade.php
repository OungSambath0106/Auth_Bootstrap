<style>
    .profile {
        width: 100px !important;
        height: 100px !important;
    }
</style>

<nav>
    <div class="container-fluid pt-3">
        <div class="row">
            <div class="col-7">
                <h1 class="title">{{ config('app.name') }}</h1>
                <h4 class="date">Date: {{ now()->format('l, F j, Y') }}</h4>
            </div>
            <div class="col-1 p-0 mt-3 d-flex justify-content-center">
            </div>
            <div class="col-4">
                <div class="row admin">
                    <a type="button" data-bs-toggle="modal" data-bs-target="#profile" class="col-3"
                        style="padding-top: 10px">
                        @if (Auth::user()->image)
                            <img class="profile" src="{{ asset('storage/uploads/users_photo/' . Auth::user()->image) }}"
                                alt="Profile Image">
                        @else
                            <img class="profile" src="{{ asset('Image/default-image.png') }}"
                                alt="Default Profile Image">
                        @endif
                    </a>
                    @include('role-permission.user.profile')
                    <div class="col-7" style="padding-top: 35px; padding-left:25px">
                        <h4 class="name">
                            <strong>{{ Auth::user()->name }}</strong>
                        </h4>
                        <h5 class="positions" style="color: #839bf2">
                            {{ implode(', ', Auth::user()->roles()->pluck('name')->toArray()) }}
                        </h5>
                    </div>

                    <div class="col-2 p-0 d-flex justify-content-end p-3">
                        <i class="fas fa-regular fa-bell" style="color: #3559E0; font-size:25px"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
